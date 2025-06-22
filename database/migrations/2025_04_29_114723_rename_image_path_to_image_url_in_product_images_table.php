<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameImagePathToImageUrlInProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_images', function (Blueprint $table) {
            // Renaming the 'image_path' column to 'image_url'
            $table->renameColumn('image_path', 'image_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_images', function (Blueprint $table) {
            // Revert column name back to 'image_path' in case of rollback
            $table->renameColumn('image_url', 'image_path');
        });
    }
}
