<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->nullable()->after('remember_token');
            $table->string('username')->nullable()->after('image');  
            $table->string('phone')->nullable()->after('username');  
            $table->timestamp('join_date')->nullable()->after('phone');  
            $table->string('country')->nullable()->after('join_date');  
            $table->string('language')->nullable()->after('country');  
            $table->string('address')->nullable()->after('language');  
            $table->integer('gender')->nullable()->after('address');  
            $table->string('department')->nullable()->after('gender');  
            $table->string('designation')->nullable()->after('department');  
            $table->integer('duty_schedule')->nullable()->after('designation');               
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
