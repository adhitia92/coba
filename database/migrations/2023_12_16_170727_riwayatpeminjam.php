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
        Schema::create('riwayatpeminjam', function (Blueprint $table) {
            $table->bigIncrements('idriwayatpeminjam');
            $table->unsignedBigInteger('idkategori');
            $table->unsignedBigInteger('idpeminjam');
            $table->unsignedBigInteger('idbarang');
            $table->unsignedBigInteger('idpeminjaman');


            $table->enum('statusbarang', ['dipinjam','dikembalikan'])->default('dipinjam');
            $table->timestamps();
            $table->foreign('idpeminjaman')->references('idpeminjaman')->on('peminjaman')->cascadeOnDelete();
            $table->foreign('idbarang')->references('idbarang')->on('barang')->cascadeOnDelete();
            $table->foreign('idkategori')->references('idkategori')->on('kategori')->cascadeOnDelete();
            $table->foreign('idpeminjam')->references('idpeminjam')->on('peminjam')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayatpeminjam');
    }
};
