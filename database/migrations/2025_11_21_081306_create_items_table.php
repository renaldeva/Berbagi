<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
        
            // FIX kategori
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');
        
            $table->string('kondisi');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
        
            // RELASI USER
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
        
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
