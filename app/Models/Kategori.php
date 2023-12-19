<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';

    protected $fillable = [
        'namakategori',
        'jenis',
        'merk',
        'created_at',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'idkategori', 'idbarang');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'idkategori');
    }
    public function lokasibarang()
    {
        return $this->hasMany(Lokasibarang::class, 'idkategori');
    }

    public function riwayatbarang()
    {
        return $this->hasMany(Lokasibarang::class, 'idriwayatbarang');
    }
    public function riwayatpeminajm()
    {
        return $this->hasMany(Lokasibarang::class, 'idriwayatpeminjam');
    }
}

