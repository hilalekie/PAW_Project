<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['konsol_id']);
            $table->renameColumn('konsol_id', 'ruangan_id');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('ruangan_id')
                ->references('id')
                ->on('ruangans')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['ruangan_id']);
            $table->renameColumn('ruangan_id', 'konsol_id');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('konsol_id')
                ->references('id')
                ->on('konsols')
                ->cascadeOnDelete();
        });
    }
};