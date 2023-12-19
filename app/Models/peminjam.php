<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjam extends Model
{
    use HasFactory;

    protected $table = 'peminjam';
    protected $primaryKey = 'idpeminjam';

    protected $fillable = ['id', 'namapeminjam', 'kontak', 'instansi', 'keterangan', 'tanggalpengembalian', 'durasi', 'created_at'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'idpeminjam', 'idpeminjam');
    }
    public function riwayatbarang()
    {
        return $this->hasMany(riwayatbarang::class, 'idpeminjam', 'idpeminjam');
    }
    public function riwayatpeminajm()
    {
        return $this->hasMany(Lokasibarang::class, 'idriwayatpeminjam');
    }

    public function getpeminjamData($idpeminjam)
    {
        $peminjam = peminjam::find($idpeminjam);

        if ($peminjam) {
            // Return the peminjam data as an array
            return [
                'nama_peminjam' => $peminjam->namapeminjam,
                'instansi_peminjam' => $peminjam->instansi,
            ];
        }

        // Return an error response if peminjam not found
        return ['error' => 'peminjam not found'];
    }
}

