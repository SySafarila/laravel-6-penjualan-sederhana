<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Invoice;
use App\InvoiceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $total = 0;
        $invoice_code = uniqid('INV-');
        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();

        foreach ($carts as $cart) {
            $total = $total + $cart->total;
        }

        // return $carts;

        $invoice = Invoice::create([
            'user_id' => Auth::user()->id,
            'total' => $total,
            'code' => $invoice_code
        ]);

        foreach ($carts as $cart) {
            InvoiceProduct::create([
                'invoice_id' => $invoice->id,
                'product' => $cart->product->name,
                'price' => $cart->product->price,
                'quantity' => $cart->quantity,
                'total' => $cart->product->price * $cart->quantity
            ]);
        }

        return 'invoice created';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
