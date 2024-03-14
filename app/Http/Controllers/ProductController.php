<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Product;


class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::get();
        return view('product.list', ['products' => $products]);
    }

    public function view($id)
    {
        $product = Product::where('uuid', $id)->first();
        return view('product.view', ['product' => $product]);
    }
}
