<?php

namespace Database\Seeders;

use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        ProductImage::create([
            'product_id' => 1,
            'tooltip' => 'gambar-1-asus',
            'src_img' => '/uploads/asus1.png',
        ]);
        ProductImage::create([
            'product_id' => 1,
            'tooltip' => 'gambar-2-asus',
            'src_img' => '/uploads/asus2.png',
        ]);
        ProductImage::create([
            'product_id' => 1,
            'tooltip' => 'gambar-3-asus',
            'src_img' => '/uploads/asus3.png',
        ]);

        ProductImage::create([
            'product_id' => 2,
            'tooltip' => 'gambar-1-macbook',
            'src_img' => '/uploads/mac1.png',
        ]);
        ProductImage::create([
            'product_id' => 2,
            'tooltip' => 'gambar-2-macbook',
            'src_img' => '/uploads/mac2.png',
        ]);
        ProductImage::create([
            'product_id' => 2,
            'tooltip' => 'gambar-3-macbook',
            'src_img' => '/uploads/mac3.png',
        ]);
    }
}
