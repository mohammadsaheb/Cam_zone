<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create some sample reviews for products
        Review::create([
            'user_id' => 1, // Assuming the user with ID 1 exists
            'product_id' => 15, // Product ID for the camera
            'rating' => 5,
            'comment' => 'This camera is absolutely amazing. The quality is perfect for professional photography!',
        ]);

        Review::create([
            'user_id' => 2, // Assuming the user with ID 2 exists
            'product_id' => 18, // Product ID for another product
            'rating' => 4,
            'comment' => 'Great lens! Works perfectly, but a little heavy for long shoots.',
        ]);

        Review::create([
            'user_id' => 3, // Assuming the user with ID 3 exists
            'product_id' => 25, // Product ID for the lens
            'rating' => 4,
            'comment' => 'Good lens with sharp focus. However, autofocus could be faster.',
        ]);

        Review::create([
            'user_id' => 1, // Assuming the user with ID 1 exists
            'product_id' => 26, // Product ID for another product
            'rating' => 5,
            'comment' => 'Love this lens! Perfect for portraits and great value for the price.',
        ]);

        Review::create([
            'user_id' => 2, // Assuming the user with ID 2 exists
            'product_id' => 27, // Product ID for the camera lens
            'rating' => 5,
            'comment' => 'Best lens I have used so far! Image quality is outstanding.',
        ]);
    }
}
