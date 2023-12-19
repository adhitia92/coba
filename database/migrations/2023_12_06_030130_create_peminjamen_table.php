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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigIncrements('idpeminjaman');
            $table->unsignedBigInteger('idkategori');
            $table->unsignedBigInteger('idbarang');
            $table->unsignedBigInteger('idpeminjam');


            $table->foreign('idkategori')->references('idkategori')->on('kategori')->cascadeOnDelete();
            $table->foreign('idbarang')->references('idbarang')->on('barang')->cascadeOnDelete();
            $table->foreign('idpeminjam')->references('idpeminjam')->on('peminjam')->cascadeOnDelete();
            $table->enum('statuspeminjaman', ['proses', 'selesai'])->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
