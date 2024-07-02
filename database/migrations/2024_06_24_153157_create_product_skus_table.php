<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product_skus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('sku', 50);
            $table->string('name', 100)->nullable();
            $table->string('spec', 100)->nullable();
            $table->float('weight')->nullable();
            $table->integer('tax_rate')->nullable();
            $table->integer('cost_price')->nullable();
            $table->integer('sale_price')->nullable();
            $table->integer('stock')->nullable();
            $table->string('status', 20)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('product_skus');
    }
};
