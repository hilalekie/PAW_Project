<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('konsols', 'ruangans');

        Schema::table('ruangans', function (Blueprint $table) {
            $table->renameColumn('nama_konsol', 'nama_ruangan');
            $table->dropColumn('ruangan');
        });
    }

    public function down(): void
    {
        Schema::table('ruangans', function (Blueprint $table) {
            $table->string('ruangan')->nullable();
            $table->renameColumn('nama_ruangan', 'nama_konsol');
        });

        Schema::rename('ruangans', 'konsols');
    }
};