<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'seller']);
    }

    public function index(Product $product)
    {
        $images = ProductImage::where('product_id', $product->id)->get();

        // return $images;
        return view('products.images.edit', compact('images'));
    }

    public function deleteImage(Product $product, ProductImage $image)
    {
        if (Storage::disk('local')->exists('public/productImages/' . $image->image)) {
            Storage::disk('local')->move('public/productImages/' . $image->image, 'trash/productImages/' . $image->image);
        }

        ProductImage::destroy($image->id);
        return redirect()->route('products.images', $product)->with('status', 'Images deleted !');
    }

    public function upload(Request $request, Product $product)
    {
        $request->validate([
            'images.*' => ['required', 'mimes:png,jpg']
        ]);

        if ($request->hasFile('images') == true) {
            foreach ($request->file('images') as $image) {
                $random = Str::random(10);
                $imgName = $random . '-' . $image->getClientOriginalName();

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imgName
                ]);

                $image->storeAs('public/productImages/', $imgName);
            }
        }
        return redirect()->route('products.images', $product)->with('status', 'Images uploaded !');
    }
}
