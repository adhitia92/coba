<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'idbarang';

    protected $fillable = [
        'namakategori',
        'jenis',
        'merk',
        'kondisi',
        'kodebarcode',
        'asal',
        'created_at',
        'statusbarang',
        'idkategori',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'idbarang');
    }
    public function lokasibarang()
    {
        return $this->hasMany(Lokasibarang::class, 'idbarang');
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

