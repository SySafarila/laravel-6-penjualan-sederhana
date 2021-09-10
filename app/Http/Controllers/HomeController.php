<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        // $products = Product::paginate(10);
        // return view('welcome', compact('products'));
        $ourMenu = Product::limit(3)->get();
        $ourMenuBottom = Product::limit(12)->get();

        return view('landingpage');
    }
}
