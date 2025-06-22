<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // عرض كل الفئات
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // صفحة إضافة فئة جديدة
    public function create()
    {
        return view('admin.categories.create');
    }

    // تخزين فئة جديدة
    public function store(Request $request)
    {
        // حل مشكلة is_active مع checkbox
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug'        => 'required|unique:categories,slug',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active'   => 'boolean',
        ]);

        $data = $request->only(['name', 'description', 'slug', 'is_active']);

        // معالجة الصورة إن وجدت
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category added successfully!');
    }

    // عرض فئة واحدة
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    // صفحة تعديل الفئة
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // تحديث الفئة
    public function update(Request $request, Category $category)
    {
        // حل مشكلة is_active مع checkbox
        $request->merge([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug'        => 'required|unique:categories,slug,' . $category->id,
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active'   => 'boolean',
        ]);

        $data = $request->only(['name', 'description', 'slug', 'is_active']);

        // معالجة الصورة إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    // حذف الفئة
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
