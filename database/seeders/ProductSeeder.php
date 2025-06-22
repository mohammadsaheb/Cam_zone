<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;  // Assuming you have categories like 'Cameras' and 'Lenses'
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Fetch categories for assignment (Cameras, Lenses, etc.)
        $categories = Category::all();  // Ensure you have categories like 'Cameras' and 'Lenses'
        // Sample product 1 - Sony a1 II Mirrorless Camera
        Product::create([
            'name' => 'Sony a1 II Mirrorless Camera',
            'description' => 'The Sony a1 II Mirrorless Camera is a powerful and versatile camera that combines high resolution with fast performance. It features a 35.9MP full-frame Exmor RS CMOS sensor and dual BIONZ XR image processors, allowing for continuous shooting at up to 30 fps with the electronic shutter. The camera also supports 8K video recording at 30p and 4K video recording at up to 120p, making it ideal for both photography and videography.',
            'price' => 4608,
            'quantity' => 10,
            'category_id' => $categories->where('name', 'Cameras')->first()->id, // Assuming 'Lenses' category
            'brand' => 'Sony',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);
        

      

        // Sample product 2 - Canon EOS R6 Mark II Mirrorless Camera
        Product::create([
            'name' => 'Canon EOS R6 Mark II Mirrorless Camera',
            'description' => 'Matching strong photo performance with apt video capabilities, the Canon EOS R6 Mark II is a versatile mirrorless body for the multimedia creator. An updated 24.2MP CMOS sensor pairs with updated processing for more improved AF, impressive 4K 60p 10-bit video, and faster overall performance. Also, the camera body has been updated for more intuitive handling, including a redesigned top plate for easier access to different shooting modes.',
            'price' => 1400,
            'quantity' => 15,
            'category_id' => $categories->where('name', 'Cameras')->first()->id, // Assuming 'Cameras' category
            'brand' => 'Canon',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);

        // Sample product 3 - Sony FE 70-200mm f/4 Macro G OSS II Lens
        Product::create([
            'name' => 'Sony FE 70-200mm f/4 Macro G OSS II Lens (Sony E)',
            'description' => 'Nine years in the making, Sony has retooled their classic, workhorse telephoto zoom lens with the FE 70-200mm f/4 Macro G OSS II, introducing performance upgrades in autofocus, stabilization, magnification, and sharpness while reducing both its length and size. Remaining a portable, workaday stalwart for events, sports, and portraiture, this latest iteration expands its capabilities into video and macro applications.',
            'price' => 1200,
            'quantity' => 10,
            'category_id' => $categories->where('name', 'Lenses')->first()->id, // Assuming 'Lenses' category
            'brand' => 'Sony',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);

        // Sample product 4 - Canon RF 24-70mm f/2.8 L IS USM Lens
        Product::create([
            'name' => 'Canon RF 24-70mm f/2.8 L IS USM Lens',
            'description' => 'Poised to be the new workhorse zoom, the Canon RF 24-70mm f/2.8 L IS USM is a versatile wide-angle to portrait-length lens characterized by its bright, advanced, and intuitive design. The constant f/2.8 maximum aperture suits working in difficult lighting conditions and also enables greater control over depth of field. The optical design incorporates a series of aspherical and Ultra-Low Dispersion elements, which greatly reduce a variety of aberrations throughout the zoom range in order to produce sharp and clear imagery. An Air Sphere Coating has also been applied to suppress flare and ghosting when working in strong lighting conditions.',
            'price' => 1700,
            'quantity' => 12,
            'category_id' => $categories->where('name', 'Lenses')->first()->id, // Assuming 'Lenses' category
            'brand' => 'Canon',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);
        Product::create([
            'name' => 'Nikon Z5 II Mirrorless Camera',
            'description' => 'A trustworthy tool for your creative journey, the Nikon Z5 II upgrades its predecessor with improved processing speed, subject recognition AF, and low-light performance. With a new color preset button, an ultra-bright viewfinder, and easy sharing options, the camera offers a step up to creators seeking full-frame imagery.',
            'price' => 1203.48,
            'quantity' => 12,
            'category_id' => $categories->where('name', 'Cameras')->first()->id, // Assuming 'Lenses' category
            'brand' => 'Nikon',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);
        Product::create([
            'name' => 'Nikon D850 DSLR Camera',
            'description' => 'Proving that speed and resolution can indeed coexist, the Nikon D850 is a multimedia DSLR that brings together robust stills capabilities along with apt movie and time-lapse recording. Revolving around a newly designed 45.7MP BSI CMOS sensor and proven EXPEED 5 image processor, the D850 is clearly distinguished by its high resolution for recording detailed imagery',
            'price' => 1270,
            'quantity' => 10,
            'category_id' => $categories->where('name', 'Cameras')->first()->id, // Assuming 'Lenses' category
            'brand' => 'Nikon',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);
        Product::create([
            'name' => 'Nikon AF-S NIKKOR 200-500mm f/5.6E ED VR Lens',
            'description' => 'Spanning a long, versatile zoom range, the AF-S NIKKOR 200-500mm f/5.6E ED VR Lens from Nikon is a telephoto zoom characterized by a constant f/5.6 maximum aperture for consistent performance throughout the zoom range. The optical design incorporates three extra-low dispersion glass elements to reduce chromatic aberrations and distortions for increased sharpness and color accuracy. ',
            'price' => 989,
            'quantity' => 6,
            'category_id' => $categories->where('name', 'Lenses')->first()->id, // Assuming 'Lenses' category
            'brand' => 'Nikon',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);
          // Sample product  - Canon EOS R5 Mark II Mirrorless Camera
          Product::create([
            'name' => 'Canon EOS R5 Mark II Mirrorless Camera',
            'description' => 'Boasting enough horsepower to allow Canon\'s highest resolution mirrorless sensor to shoot a speedy 30 fps and capture 8K60p raw video, the EOS R5 Mark II Mirrorless Camera is the multimedia professional\'s solution for versatility, image quality, and intelligence. An all-new 45MP sensors stacked, back-illuminated design joins a brand new processor to provide upgrades in nearly every category, creating a do-it-all camera that gets the job done.',
            'price' => 2100,
            'quantity' => 10,
            'category_id' => $categories->where('name', 'Cameras')->first()->id, // Assuming 'Cameras' is in the category table
            'brand' => 'Canon',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);
        Product::create([
            // Sample product  - Sony a7R V Mirrorless Camera
            'name' => 'Sony a7R V Mirrorless Camera',
            'description' => 'The Sony a7R V Mirrorless Camera is a high-resolution full-frame camera that features a 61MP Exmor R BSI CMOS sensor and dual BIONZ XR image processors. It offers fast continuous shooting at up to 10 fps with the mechanical shutter and 8K video recording at 30p. The camera also has advanced autofocus capabilities with Real-time Eye AF for humans and animals, making it ideal for both photography and videography.',
            'price' => 2480,
            'quantity' => 10,
            'category_id' => $categories->where('name', 'Cameras')->first()->id, // Assuming 'Cameras' is in the category table
            'brand' => 'Sony',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);
        Product::create([
            // Sample product 10 - Canon RF 50mm f/1.2 L USM Lens
            'name' => 'Canon RF 50mm f/1.2 L USM Lens',
            'description' => 'The Canon RF 50mm f/1.2 L USM Lens is a high-performance standard prime lens designed for Canon\'s full-frame mirrorless cameras. It features a fast f/1.2 maximum aperture for excellent low-light performance and shallow depth of field control. The lens incorporates advanced optics to minimize aberrations and distortion, ensuring sharp and clear images.',
            'price' => 1630,
            'quantity' => 10,
            'category_id' => $categories->where('name', 'Lenses')->first()->id, // Assuming 'Lenses' is in the category table
            'brand' => 'Canon',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);
        // Sample product11  - Nikon Z 24-70mm f/2.8 S Lens
        Product::create([
            'name' => 'Nikon Z 24-70mm f/2.8 S Lens',
            'description' => 'The Nikon Z 24-70mm f/2.8 S Lens is a versatile standard zoom lens designed for Nikon\'s full-frame mirrorless cameras. It features a constant f/2.8 maximum aperture for consistent performance throughout the zoom range. The lens incorporates advanced optics to minimize aberrations and distortion, ensuring sharp and clear images.',
            'price' => 1399,
            'quantity' => 10,
            'category_id' => $categories->where('name', 'Lenses')->first()->id, // Assuming 'Lenses' is in the category table
            'brand' => 'Nikon',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);
        // Sample product12  - Canon RF 85mm f/1.2 L USM Lens
        Product::create([
            'name' => 'Canon RF 85mm f/1.2 L USM Lens',
            'description' => 'The Canon RF 85mm f/1.2 L USM Lens is a high-performance portrait lens designed for Canon\'s full-frame mirrorless cameras. It features a fast f/1.2 maximum aperture for excellent low-light performance and shallow depth of field control. The lens incorporates advanced optics to minimize aberrations and distortion, ensuring sharp and clear images.',
            'price' => 1989,
            'quantity' => 10,
            'category_id' => $categories->where('name', 'Lenses')->first()->id, // Assuming 'Lenses' is in the category table
            'brand' => 'Canon',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);
        // Sample product13  - Nikon Z 14-30mm f/4 S Lens
        Product::create([
            'name' => 'Nikon Z 14-30mm f/4 S Lens',
            'description' => 'The Nikon Z 14-30mm f/4 S Lens is a wide-angle zoom lens designed for Nikon\'s full-frame mirrorless cameras. It features a constant f/4 maximum aperture for consistent performance throughout the zoom range. The lens incorporates advanced optics to minimize aberrations and distortion, ensuring sharp and clear images.',
            'price' => 799,
            'quantity' => 10,
            'category_id' => $categories->where('name', 'Lenses')->first()->id, // Assuming 'Lenses' is in the category table
            'brand' => 'Nikon',
            'is_featured' => true, // Mark as featured
            'is_active' => true, // Active product
        ]);

        
     


        // Create 6 more random products
        
        
    }
}
