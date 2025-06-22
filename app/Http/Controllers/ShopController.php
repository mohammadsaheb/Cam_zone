<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display the shop page with products and filters
     */
    public function index(Request $request)
    {
        // Start with active products query - modify image loading to prioritize main images
        $productsQuery = Product::where('is_active', true)
                        ->with(['category', 'images' => function($query) {
                            $query->orderBy('is_main', 'desc');
                        }]);
        
        // Apply category filter
        if ($request->has('category') && $request->category != '') {
            $productsQuery->where('category_id', $request->category);
        }
        
        // Apply brand filter
        if ($request->has('brand') && $request->brand != '') {
            $productsQuery->where('brand', $request->brand);
        }
        
        // Apply price range filter
        if ($request->has('min_price') && $request->has('max_price')) {
            $productsQuery->whereBetween('price', [$request->min_price, $request->max_price]);
        } else if ($request->has('min_price')) {
            $productsQuery->where('price', '>=', $request->min_price);
        } else if ($request->has('max_price')) {
            $productsQuery->where('price', '<=', $request->max_price);
        }
        
        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low_high':
                    $productsQuery->orderBy('price', 'asc');
                    break;
                case 'price_high_low':
                    $productsQuery->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $productsQuery->orderBy('created_at', 'desc');
                    break;
                default:
                    $productsQuery->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            // Default sorting
            $productsQuery->orderBy('created_at', 'desc');
        }
        
        // Get the products with pagination - preload images limited to what's needed
        $products = $productsQuery->paginate(12);
        
        // Preload main images for visible products
        $preloadImages = [];
        foreach ($products->take(6) as $product) {
            $mainImage = $product->images->first(); // First image due to our orderBy('is_main', 'desc')
            if ($mainImage) {
                $preloadImages[] = asset('storage/' . $mainImage->image_url);
            }
        }
        
        // Get all categories for the filter
        $categories = Category::all();
        
        // Get all brands for the filter (from your existing products)
        $brands = Product::distinct()->where('is_active', true)->pluck('brand');
        
        // Get price range for slider
        $minProductPrice = Product::min('price') ?: 0;
        $maxProductPrice = Product::max('price') ?: 1000;
        
        // Get the selected filters
        $selectedCategory = $request->category;
        $selectedBrand = $request->brand;
        $selectedSort = $request->sort ?? 'newest';
        $minPrice = $request->min_price ?? $minProductPrice;
        $maxPrice = $request->max_price ?? $maxProductPrice;
        
        return view('shop.index', compact(
            'products',
            'categories',
            'brands',
            'selectedCategory',
            'selectedBrand',
            'selectedSort',
            'minPrice',
            'maxPrice',
            'minProductPrice',
            'maxProductPrice',
            'preloadImages'
        ));
    }
    
    /**
     * Show a single product
     */
    public function show($id)
    {
        $product = Product::with(['category', 'images' => function($query) {
            $query->orderBy('is_main', 'desc');
        }])->findOrFail($id);
        
        // Get related products (same category) - optimized query for images
        $relatedProducts = Product::where('category_id', $product->category_id)
                            ->where('id', '!=', $product->id)
                            ->where('is_active', true)
                            ->with(['images' => function($query) {
                                $query->orderBy('is_main', 'desc');
                            }])
                            ->take(4)
                            ->get();
        
        return view('shop.show', compact('product', 'relatedProducts'));
    }
}