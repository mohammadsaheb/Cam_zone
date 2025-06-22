<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   

   public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->date('booking_date');
        $table->time('start_time');
        $table->time('end_time');
        $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
        $table->string('service_type');
        $table->decimal('price', 8, 2);
        $table->text('notes')->nullable();
        $table->string('location')->default('CamZone Studio');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
