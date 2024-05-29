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
        Schema::create('pinjaman_buku_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_buku_id')->constrained('pinjaman_buku');
            $table->foreignId('buku_id')->constrained('buku');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjaman_buku_item');
    }
};
