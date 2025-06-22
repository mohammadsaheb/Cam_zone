<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        // Fetch all products to associate images
        $products = Product::all();

        foreach ($products as $product) {
            // Assign real image URLs based on product IDs
            $imageUrls = [];

            // Assign images based on product ID
            if ($product->id == 1) { // sony a1 camera
                $imageUrls = [
                    'https://static.bhphoto.com/images/images500x500/1732015006_1861705.jpg',
                ];
            }

            if ($product->id == 2) { // Canon EOS R6 Mark II Mirrorless Camera
                $imageUrls = [
                    'https://www.bhphotovideo.com/cdn-cgi/image/fit=scale-down,width=500,quality=95/https://www.bhphotovideo.com/images/images500x500/canon_eos_r6_mark_ii_1667348713_1733214.jpg',
                ];
            }

            if ($product->id == 3) { // Sony FE 70-200mm f/4 Macro G OSS II Lens
                $imageUrls = [
                    'https://www.bhphotovideo.com/cdn-cgi/image/fit=scale-down,width=500,quality=95/https://www.bhphotovideo.com/images/images500x500/sony_fe_70_200mm_f_4_g_1689157242_1776284.jpg',
                ];
            }

            if ($product->id == 4) { // Canon RF 24-70mm f/2.8 L IS USM Lens
                $imageUrls = [
                    'https://www.bhphotovideo.com/cdn-cgi/image/fit=scale-down,width=500,quality=95/https://www.bhphotovideo.com/images/images500x500/canon_3680c002_rf_24_70mm_f_2_8l_is_1566949680_1502500.jpg',
                ];
            }
            if ($product->id == 5) { // Nikon Z5 II Mirrorless Camera
                $imageUrls = [
                    'https://static.bhphoto.com/images/images500x500/1743641150_1889823.jpg',
                ];
            }
            if ($product->id == 6) { // Nikon D850 DSLR Camera
                $imageUrls = [
                    'https://static.bhphoto.com/images/images500x500/1706268322_1351688.jpg',
                ];
            }
            if ($product->id == 7) { // Nikon D850 DSLR Camera
                $imageUrls = [
                    'https://static.bhphoto.com/images/images500x500/1438656707_1175034.jpg',
                ];
            }
            if ($product->id == 8) { // Canon EOS R5 Mark II Mirrorless Camera
                $imageUrls = [
                    'https://www.bhphotovideo.com/cdn-cgi/image/fit=scale-down,width=500,quality=95/https://www.bhphotovideo.com/images/images500x500/canon_6536c002_eos_r5_mark_ii_1721198413_1840289.jpg',
                ];
            }
            if ($product->id ==9) { // SONY a7R V Mirrorless Camera
                $imageUrls = [
                    'https://static.bhphoto.com/images/images500x500/1666779545_1731389.jpg',
                ];
            }
            if ($product->id == 10) { // 
                $imageUrls = [
                    'https://static.bhphoto.com/images/images500x500/1604443681_1601517.jpg',
                ];
            }
            if ($product->id == 11) { // 
                $imageUrls = [
                    'https://static.bhphoto.com/images/images500x500/1550112618_1459622.jpg',
                ];
            }
            if ($product->id == 12) { // 
                $imageUrls = [
                    'https://static.bhphoto.com/images/images500x500/1557272709_1477265.jpg',
                ];
            }
            if ($product->id == 13) { // 
                $imageUrls = [
                    'https://static.bhphoto.com/images/images500x500/1546905029_1452459.jpg',
                ];
            }


            // Add more conditions for other products as needed

            // Create images for each product
            foreach ($imageUrls as $imageUrl) {
                ProductImage::create([
                    'product_id' => $product->id, // Associate image with the product
                    'image_url' => $imageUrl, // Store the image URL
                ]);
            }
        }
    }
}
