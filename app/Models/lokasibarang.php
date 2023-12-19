<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasibarang extends Model
{
    use HasFactory;

    protected $table = 'lokasibarang';
    protected $primaryKey = 'idlokasibarang';

    protected $fillable = [
        'idkategori',
        'idbarang',
        'idlokasi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idbarang');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'idlokasi');
    }
}
