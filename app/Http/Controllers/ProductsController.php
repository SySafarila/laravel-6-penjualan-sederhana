<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('seller')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        $number = 1;
        return view('products.index', compact('products', 'number'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric']
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        if ($request->hasFile('images') == true) {
            foreach ($request->file('images') as $image) {
                $random = Str::random(10);
                $imgName = $random . '-' . $image->getClientOriginalName();

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imgName
                ]);

                $image->storeAs('/public/productImages', $imgName);
            }
        }

        return redirect()->route('products.index')->with('status', 'Product created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::with('images')->find($product)->first();
        // return $product;
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric']
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        foreach ($product->images as $image) {
            if (Storage::disk('local')->exists('public/productImages/' . $image->image)) {
                Storage::disk('local')->delete('public/productImages/' . $image->image);
            }
            ProductImage::destroy($image->id);
        }

        if ($request->hasFile('images') == true) {
            foreach ($request->file('images') as $image) {
                $random = Str::random(10);
                $imgName = $random . '-' . $image->getClientOriginalName();

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imgName
                ]);

                $image->storeAs('/public/productImages', $imgName);
            }
        }

        return redirect()->route('products.index')->with('status', 'Product updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // return $product->images[0];
        foreach ($product->images as $image) {
            if (Storage::disk('local')->exists('public/productImages/' . $image->image)) {
                Storage::disk('local')->move('public/productImages/' . $image->image, 'trash/productImages/' . $image->image);
            }
            ProductImage::destroy($image->id);
        }
        Cart::where('product_id', $product->id)->first()->delete();
        $product->delete();

        return redirect()->route('products.index')->with('status', 'Product deleted !');
    }
}
