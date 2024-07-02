<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sku_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_sku_id')->constrained('product_skus')->onDelete('cascade');
            $table->string('image_path', 500);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sku_images');
    }
};
