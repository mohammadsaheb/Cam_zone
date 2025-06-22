<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // عرض كل المنتجات
    public function index()
    {
        $products = Product::with(['category', 'images' => function($query) {
            $query->orderBy('is_main', 'desc');
        }])->orderBy('created_at', 'desc')->get();
        
        return view('admin.products.index', compact('products'));
    }

    // صفحة إضافة منتج جديد
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // حفظ منتج جديد مع الصور
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand'       => 'required|in:Canon,Nikon,Sony,Other',
            'is_featured' => 'nullable|boolean',
            'is_active'   => 'nullable|boolean',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::create($request->except('images'));

        // حفظ الصور باستخدام اسم العمود الصحيح (image_url)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('uploads/products', 'public');
                
                // إنشاء صورة جديدة مع اسم العمود الصحيح
                $product->images()->create([
                    'image_url' => $path,
                    'is_main' => ($index === 0) ? true : false, // أول صورة تكون رئيسية
                    'alt_text' => $product->name // نص بديل افتراضي
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    // صفحة عرض منتج واحد مع الصور
    public function show(Product $product)
    {
        $product->load(['category', 'images' => function($query) {
            $query->orderBy('is_main', 'desc');
        }]);
        
        return view('admin.products.show', compact('product'));
    }

    // صفحة تعديل منتج
    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load(['images' => function($query) {
            $query->orderBy('is_main', 'desc');
        }]);
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // تحديث منتج مع إضافة صور جديدة إذا وجدت
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand'       => 'required|in:Canon,Nikon,Sony,Other',
            'is_featured' => 'nullable|boolean',
            'is_active'   => 'nullable|boolean',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'main_image'  => 'nullable|exists:product_images,id', // لتحديد الصورة الرئيسية
        ]);

        $product->update($request->except(['images', 'main_image']));

        // تحديث الصورة الرئيسية إذا تم اختيارها
        if ($request->has('main_image')) {
            // إعادة تعيين جميع الصور ليست رئيسية
            $product->images()->update(['is_main' => false]);
            
            // تعيين الصورة المحددة كرئيسية
            $product->images()->where('id', $request->main_image)->update(['is_main' => true]);
        }

        // إضافة صور جديدة إذا تم رفعها
        if ($request->hasFile('images')) {
            // تحقق ما إذا كان هناك صور موجودة بالفعل
            $hasExistingImages = $product->images()->exists();
            
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('uploads/products', 'public');
                
                // تعيين أول صورة كرئيسية فقط إذا لم تكن هناك صور موجودة
                $isMain = (!$hasExistingImages && $index === 0) ? true : false;
                
                // إنشاء صورة جديدة مع اسم العمود الصحيح
                $product->images()->create([
                    'image_url' => $path,
                    'is_main' => $isMain,
                    'alt_text' => $product->name
                ]);
            }
        }

        return redirect()->route('admin.products.show', $product)->with('success', 'Product updated successfully!');
    }

    // حذف صورة محددة
    public function deleteImage($imageId)
    {
        $image = \App\Models\ProductImage::findOrFail($imageId);
        $productId = $image->product_id;
        
        // حذف الملف من التخزين
        Storage::disk('public')->delete($image->image_url);
        
        // حذف السجل من قاعدة البيانات
        $image->delete();
        
        // إذا كانت الصورة رئيسية، قم بتعيين صورة أخرى كرئيسية إذا كانت موجودة
        if ($image->is_main) {
            $nextImage = \App\Models\ProductImage::where('product_id', $productId)->first();
            if ($nextImage) {
                $nextImage->update(['is_main' => true]);
            }
        }
        
        return redirect()->back()->with('success', 'Image deleted successfully!');
    }

    // حذف منتج وجميع صوره
    public function destroy(Product $product)
    {
        // حذف الصور من التخزين قبل حذف المنتج
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_url); // تم التغيير من image_path إلى image_url
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
    
    // تعيين صورة كرئيسية
    public function setMainImage($imageId)
    {
        $image = \App\Models\ProductImage::findOrFail($imageId);
        $productId = $image->product_id;
        
        // إعادة تعيين جميع الصور لنفس المنتج ليست رئيسية
        \App\Models\ProductImage::where('product_id', $productId)
            ->update(['is_main' => false]);
        
        // تعيين الصورة المحددة كرئيسية
        $image->update(['is_main' => true]);
        
        return redirect()->back()->with('success', 'Main image updated successfully!');
    }
}