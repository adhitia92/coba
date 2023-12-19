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
        Schema::create('peminjam', function (Blueprint $table) {
            $table->bigIncrements('idpeminjam');
            $table->unsignedBigInteger('id')->nullable();
            $table->foreign('id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('namapeminjam');
            $table->string('kontak', 20);
            $table->string('instansi');
            $table->timestamp('tanggalpengembalian')->nullable();
            $table->string('keterangan');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjam');
    }
};

