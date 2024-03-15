<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Stripe\{
    Stripe,
    PaymentIntent
};
use Exception;
use App\Models\Product;
use App\Models\User;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('payment.index');
    }

    public function checkout(Request $request)
    {
        $product = Product::where('uuid', $request->id)->first();
        if (!$product) {
            return back()->with(['error', 'Invalid Product']);
        }
        try {
            $returnUrl = url('/payment');
            
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $user = User::first();
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($request->stripeToken);
          
            // $stripeCharge = $user->charge(
            //     $product->price * 100, 
            //     $request->stripeToken,
            //     [
            //         'currency' => 'inr',
            //         'return_url' => $returnUrl
            //     ]
            // );
            // echo '<pre>'; print_r($stripeCharge); exit;

            // Create a charge
            $paymentIntent = PaymentIntent::create([
                'amount' => $product->price * 100, 
                'currency' => 'inr',
                'description' => 'One-time payment',
                'payment_method' => $request->stripeToken,
                'confirm' => true,
                'return_url' => $returnUrl,
                'customer' => $user->stripe_id
            ]);
            
            $redirectUrl = $paymentIntent->next_action->redirect_to_url->return_url;
          
            return redirect($redirectUrl)->with(['status' => 'SUCCESS']);
        } catch (Exception $e) {
            return redirect('/payment')->with(['status' => 'FAILED']);
        }
    }
}
