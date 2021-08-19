<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Invoice;
use App\InvoiceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('invoiceProducts')->where('user_id', Auth::user()->id)->get();
        // return $invoices;
        return view('invoices.index', compact('invoices'));
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
                'total' => $cart->product->price * $cart->quantity,
                'status' => 'waiting payment'
            ]);

            $cart->delete();
        }

        return redirect()->route('carts.index')->with('status', 'Invoice created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        if ($invoice->user_id == Auth::user()->id) {
            return view('invoices.show', compact('invoice'));
        }
        return redirect()->route('root');
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

    public function uploadImage(Request $request, Invoice $invoice)
    {
        // return dd($request);
        if ($request->hasFile('image') == true) {
            $random = uniqid('INV-');
            $imgName = $random . '-' . $request->file('image')->getClientOriginalName();

            $invoice->update([
                'payment_image' => $imgName,
                'status' => 'payment success'
            ]);

            $request->file('image')->storeAs('/public/paymentImages/', $imgName);

            return redirect()->route('invoices.show', $invoice->id)->with('status', 'Payment uploaded !');
        }
    }
}
