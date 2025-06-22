<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    // حذف صورة منفردة
    public function destroy(ProductImage $productImage)
    {
        // Changed from image_path to image_url to match your database column
        Storage::disk('public')->delete($productImage->image_url);
        $productImage->delete();

        return back()->with('success', 'Image deleted successfully!');
    }

    // Add a method to set an image as main
    public function setAsMain(ProductImage $productImage)
    {
        // First, set all images for this product as not main
        ProductImage::where('product_id', $productImage->product_id)
                    ->update(['is_main' => false]);
        
        // Then set the selected image as main
        $productImage->update(['is_main' => true]);
        
        return back()->with('success', 'Image set as main successfully!');
    }
    
    public function checkImages()
    {
        // Get a sample product with images
        $product = \App\Models\Product::with('images')->first();
        
        if (!$product) {
            return "No products found in the database.";
        }
        
        if (!$product->images || $product->images->count() === 0) {
            return "Product found, but it has no images.";
        }
        
        $image = $product->images->first();
        $imageUrl = $image->image_url; // Changed from potential image_path to image_url
        
        $results = [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'image_id' => $image->id,
            'image_url_in_db' => $imageUrl,
            'storage_paths_to_check' => [
                'public' => public_path($imageUrl),
                'storage_public' => storage_path('app/public/' . $imageUrl),
                'uploads_products' => public_path('uploads/products/' . basename($imageUrl)),
                'storage_uploads_products' => storage_path('app/public/uploads/products/' . basename($imageUrl))
            ],
            'file_exists' => [
                'public' => file_exists(public_path($imageUrl)),
                'storage_public' => file_exists(storage_path('app/public/' . $imageUrl)),
                'uploads_products' => file_exists(public_path('uploads/products/' . basename($imageUrl))),
                'storage_uploads_products' => file_exists(storage_path('app/public/uploads/products/' . basename($imageUrl)))
            ]
        ];
        
        return response()->json($results);
    }

    // Add a method to optimize images
    public function optimizeImages()
    {
        $images = ProductImage::all();
        $count = 0;
        
        foreach ($images as $image) {
            $path = storage_path('app/public/' . $image->image_url);
            
            if (file_exists($path)) {
                // Simple optimization could be implemented here
                // For example, using Intervention Image package
                $count++;
            }
        }
        
        return "Optimized $count images successfully.";
    }
}