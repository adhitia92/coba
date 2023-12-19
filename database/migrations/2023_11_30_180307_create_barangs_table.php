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
        Schema::create('barang', function (Blueprint $table) {
            $table->bigIncrements('idbarang');
            $table->unsignedBigInteger('idkategori');
            $table->foreign('idkategori')->references('idkategori')->on('kategori')->cascadeOnDelete();
            $table->string('kodebarcode');
            $table->string('gambar')->nullable();
            $table->enum('kondisi', ['baik','rusak'])->default('baik');
            $table->string('asal');
            $table->enum('statusbarang', ['tersedia', 'tidak_tersedia'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
