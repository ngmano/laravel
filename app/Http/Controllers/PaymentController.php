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

            // Create a charge
            $paymentIntent = PaymentIntent::create([
                'amount' => $product->price * 100, 
                'currency' => 'inr',
                'description' => 'One-time payment',
                'payment_method' => $request->stripeToken,
                'confirm' => true,
                'return_url' => $returnUrl,
            ]);   
            return redirect('/payment')->with(['status' => 'SUCCESS']);
        } catch (Exception $e) {
            return redirect('/payment')->with(['status' => 'FAILED']);
        }
    }
}
