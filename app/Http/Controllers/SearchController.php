<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchProducts(Request $request)
    {
        // return $request->name;
        if ($request->name) {
            $products = Product::where('name', 'like', '%' . $request->name . '%')->paginate(10);
            return view('welcome', compact('products'));
        } else {
            return redirect()->route('root');
        }
    }

    public function searchProductsSeller(Request $request)
    {
        // return $request->name;
        if ($request->name) {
            $products = Product::where('name', 'like', '%' . $request->name . '%')->latest()->paginate(10);
            $number = 1;
            return view('products.index', compact('products', 'number'));
        } else {
            return redirect()->route('root');
        }
    }
}
