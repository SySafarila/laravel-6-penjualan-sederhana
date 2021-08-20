<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Invoice;
use App\InvoiceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('seller')->only(['sellerIndex', 'sellerShow', 'acceptPayment', 'declinePayment']);
        $this->middleware('buyer')->only(['index', 'store', 'show', 'uploadImage', 'cancelPayment']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // buyer
        $invoices = Invoice::with('invoiceProducts')->where('user_id', Auth::user()->id)->latest()->get();
        // return $invoices;
        return view('invoices.index', compact('invoices'));
    }

    public function sellerIndex()
    {
        // seller
        if (Auth::user()->role->name == 'seller') {
            $number = 1;
            $invoices = Invoice::with('invoiceProducts')->latest()->get();
            return view('invoices.seller.index', compact('invoices', 'number'));
        }
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
        // buyer
        if ($invoice->user_id == Auth::user()->id) {
            return view('invoices.show', compact('invoice'));
        }
    }

    public function sellerShow(Invoice $invoice)
    {
        // seller
        if (Auth::user()->role->name == 'seller') {
            return view('invoices.seller.show', compact('invoice'));
        }
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

    public function acceptPayment(Invoice $invoice)
    {
        $invoice->update([
            'status' => 'complete'
        ]);

        return redirect()->route('seller.invoices.show', $invoice->id)->with('status', 'Payment accepted !');
    }

    public function declinePayment(Invoice $invoice)
    {
        $invoice->update([
            'status' => 'declined'
        ]);

        return redirect()->route('seller.invoices.show', $invoice->id)->with('status', 'Payment declined !');
    }

    public function cancelPayment(Invoice $invoice)
    {
        if (Storage::disk('local')->exists('public/paymentImages/' . $invoice->payment_image)) {
            Storage::disk('local')->delete('public/paymentImages/' . $invoice->payment_image);
        }

        $invoice->update([
            'status' => 'waiting payment'
        ]);

        return redirect()->route('invoices.show', $invoice->id)->with('status', 'Payment canceled !');
    }
}
