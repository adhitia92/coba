<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayatpeminjam extends Model
{
    use HasFactory;

    protected $table = 'Riwayatpeminjam'; // Adjust according to the actual table name

    protected $primaryKey = 'idriwayatpeminjam'; // Remove the trailing spaces

    protected $fillable = [
        'idbarang',
        'idkategori',
        'idpeminjam',
        'idpeminjaman',
        'idbarang',
        'statusbarang',
    ];

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idbarang', 'idbarang');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'idpeminjam', 'idpeminjam');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'idpeminjaman', 'idpeminjaman');
    }

    public function riwayatpeminjam()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'idpeminjaman');
    }
}
