<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade');  // Foreign key to the `carts` table
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');  // Foreign key to the `products` table
            $table->integer('quantity')->default(1);  // Quantity of this product in the cart
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};

