<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['searchProducts']);
        $this->middleware(['auth', 'seller'])->only(['searchProductsSeller', 'searchInvoicesSeller']);
        $this->middleware(['auth', 'buyer'])->only(['searchInvoices']);
    }
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

    public function searchInvoices(Request $request)
    {
        if ($request->code) {
            $invoices = Invoice::where([
                ['code', 'like', '%' . $request->code . '%'],
                ['user_id', Auth::user()->id],
            ])->with('invoiceProducts')->latest()->paginate(10);
            return view('invoices.index', compact('invoices'));
        } else {
            return redirect()->route('invoices.index');
        }
    }

    public function searchInvoicesSeller(Request $request)
    {
        if ($request->code) {
            $number = 1;
            $invoices = Invoice::where('code', 'like', '%' . $request->code . '%')->with('invoiceProducts')->latest()->paginate(10);
            return view('invoices.seller.index', compact('invoices', 'number'));
        } else {
            return redirect()->route('seller.invoices.index');
        }
    }
}
