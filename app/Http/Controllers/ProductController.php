<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\{
    User,
    Product
};


class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::get();
        return view('product.list', ['products' => $products]);
    }

    public function view(Product $product)
    {
        $user = User::first();
        $product = Product::where('uuid', $product->uuid)->first();
        return view('product.view', ['product' => $product, 'intent' => $user->createSetupIntent()]);
    }
}
