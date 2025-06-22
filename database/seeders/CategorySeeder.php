<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Cameras',
            'description' => 'All kinds of cameras',
            'slug' => 'cameras',
            'is_active' => 1,
        ]);

        Category::create([
            'name' => 'Lenses',
            'description' => 'All types of camera lenses',
            'slug' => 'lenses',
            'is_active' => 1,
        ]);
    }
}
