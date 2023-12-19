<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $primaryKey = 'idlokasi';

    protected $fillable = [
        'idlokasi',
        'namalokasi',
    ];

    public function lokasibarangs()
    {
        return $this->hasMany(lokasibarang::class, 'idlokasi', 'idlokasi');
    }
}
