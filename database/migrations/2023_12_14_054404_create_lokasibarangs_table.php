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
        Schema::create('lokasibarang', function (Blueprint $table) {
            $table->bigIncrements('idlokasibarang');
            $table->unsignedBigInteger('idkategori');
            $table->unsignedBigInteger('idbarang');
            $table->unsignedBigInteger('idlokasi');

            $table->foreign('idkategori')->references('idkategori')->on('kategori')->cascadeOnDelete();
            $table->foreign('idbarang')->references('idbarang')->on('barang')->cascadeOnDelete();
            $table->foreign('idlokasi')->references('idlokasi')->on('lokasi')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasibarang');
    }
};
