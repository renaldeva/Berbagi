<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
            $table->date('tanggal')->nullable();
            $table->time('waktu')->nullable();
            $table->string('lokasi')->nullable();
            $table->enum('status', ['terjadwal','selesai','batal'])->default('terjadwal');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
