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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name'); 
			$table->string('site_icon')->nullable(); 
			$table->string('site_logo')->nullable(); 
			$table->string('facebook_url')->nullable(); 
			$table->string('instagram_url')->nullable(); 
			$table->string('whatsapp_number')->nullable(); 
			$table->string('intro_image_1')->nullable(); 
			$table->string('intro_image_2')->nullable(); 
			$table->string('intro_image_3')->nullable(); 
			$table->string('intro_text_1')->nullable(); 
			$table->string('intro_text_2')->nullable(); 
			$table->string('intro_text_3')->nullable(); 
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
