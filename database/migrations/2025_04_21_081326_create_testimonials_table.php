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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama pengguna
            $table->text('content'); // isi testimoni
            $table->unsignedTinyInteger('rating')->nullable(); // nilai rating 1-5
            $table->string('image')->nullable(); // foto atau avatar pelanggan
            $table->boolean('is_active')->default(true); // moderasi tampil/tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
