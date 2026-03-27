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
        Schema::create('motors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('merk_id')->constrained('merks');
            $table->foreignId('model_id')->constrained('models');
            
            $table->year('tahun');
            $table->string('gambar')->nullable();
            $table->bigInteger('harga');
            $table->integer('jarak_tempuh');
            $table->string('kondisi'); // Baru / Bekas
            $table->string('warna');
            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};
