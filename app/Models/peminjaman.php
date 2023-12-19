<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'idpeminjaman';

    protected $fillable = [
        'idkategori',
        'idbarang',
        'idpeminjam',
    ];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idbarang', 'idbarang');
    }

    // Model Peminjaman
    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'idpeminjam', 'idpeminjam');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'idpeminjaman', 'idpeminjaman');
    }


    public function riwayatpeminjam()
    {
        return $this->belongsTo(Riwayatpeminjam::class, 'idriwayatpeminjam', 'idriwayatpeminjam');
    }

    public function statuspeminjam()
    {
        return $this->peminjaman->status;
    }

    public function statusbarangriwayat()
    {
        return $this->peminjaman->statusbarang;
    }
}
