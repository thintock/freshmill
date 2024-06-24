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
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('da_first_name', 50)->nullable();
            $table->string('da_last_name', 50)->nullable();
            $table->string('da_first_kana', 50)->nullable();
            $table->string('da_last_kana', 50)->nullable();
            $table->string('da_com_name', 50)->nullable();
            $table->string('da_postal_code', 10)->nullable();
            $table->string('da_prefecture', 50)->nullable();
            $table->string('da_address1', 100)->nullable();
            $table->string('da_address2', 100)->nullable();
            $table->string('da_phone_number', 20)->nullable();
            $table->boolean('is_default')->default(false);
            $table->text('da_remarks')->nullable();
            
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('delivery_addresses');
    }
};
