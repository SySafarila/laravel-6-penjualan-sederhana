<?php

use App\ProductImage;
use Illuminate\Database\Seeder;

class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductImage::create([
            'product_id' => 1,
            'image' => 'test.png'
        ]);
    }
}
