<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'buyer'])->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
        // return $carts;
        return view('carts.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => ['required', 'numeric'],
            'product_id' => ['required', 'numeric']
        ]);

        $product = Product::find($request->product_id);

        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'total' => $product->price * $request->quantity
        ]);

        return redirect()->route('products.show', $product->id)->with('status', 'Added to your cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        return abort(404);
        if ($cart->user_id == Auth::user()->id) {
            return $cart;
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        if ($cart->user_id == Auth::user()->id) {
            return view('carts.edit', compact('cart'));
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id == Auth::user()->id) {
            $product = Product::find($cart->product_id);

            $cart->update([
                'quantity' => $request->quantity,
                'price' => $product->price,
                'total' => $product->price * $request->quantity
            ]);

            return redirect()->route('carts.index')->with('status', 'Cart updated !');
        }
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        if ($cart->user_id == Auth::user()->id) {
            $cart->delete();
            return redirect()->route('carts.index')->with('status', 'Cart deleted !');
        }
        return abort(404);
    }
}
