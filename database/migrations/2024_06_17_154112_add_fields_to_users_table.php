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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 50)->nullable()->after('name');
            $table->string('first_name_kana', 50)->nullable()->after('first_name');
            $table->string('last_name_kana', 50)->nullable()->after('first_name_kana');
            $table->string('company_name', 50)->nullable()->after('last_name_kana');
            $table->string('postal_code', 10)->nullable()->after('company_name');
            $table->string('prefecture', 50)->nullable()->after('postal_code');
            $table->string('address1', 100)->nullable()->after('prefecture');
            $table->string('address2', 100)->nullable()->after('address1');
            $table->string('phone', 20)->nullable()->after('address2');
            $table->string('role', 20)->after('email')->default('user');
            $table->string('user_type', 10)->after('role')->default('personal');
            $table->boolean('email_notification')->default(false)->after('user_type');
            $table->text('remarks')->nullable()->after('email_notification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'first_name_kana', 'last_name_kana', 
                'company_name', 'postal_code', 'prefecture', 'address1', 
                'address2', 'phone', 'role', 'email_notification', 
                'remarks', 'user_type'
            ]);
        });
    }
};
