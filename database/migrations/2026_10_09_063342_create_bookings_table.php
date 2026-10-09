<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->cascadeOnDelete();
            $table->foreignId('konsol_id')->constrained('konsols')->cascadeOnDelete();
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->integer('durasi');
            $table->integer('total_harga');
            $table->string('status')->default('dipesan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};