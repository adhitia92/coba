<?php

namespace App\Http\Controllers;
use App\Http\Controllers\peminjamancontroller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\datapeminjaman;
use App\Models\Peminjaman;
use App\Models\riwayatbarang;
use App\Models\Riwayatpeminjam;
use Illuminate\Support\Facades\Log;
use App\Models\peminjam;
use App\Models\barang;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class DatapeminjamanController extends Controller
{
    public function role()
    {
        if (Auth::id()) {
            $role = Auth::user()->role;

            if ($role == 'staff') {
                return view('dashboard');
            } elseif ($role == 'kepalalab') {
                return view('kepalalab.dashboard.index');
            } else {
                return redirect()->back();
            }
        }
    }
    public function dataToBeApproved()
    {
        if (Auth::check() && Auth::user()->role == 'kepalalab') {
            $data_penerima_peminjaman = Peminjaman::with('peminjam')
                ->whereHas('peminjam', function ($query) {
                    $query->where('status', 'menunggu');
                })
                ->get()
                ->groupBy('peminjam.idpeminjam') // Gunakan idpeminjam sebagai kunci grup
                ->map->first(); // Ambil satu item dari setiap grup

            return view('kepalalab.datapeminjaman.index', compact('data_penerima_peminjaman'));
        } else {
            return redirect('/')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }
    public function detailPeminjaman($idpeminjam)
    {
        if (Auth::check() && Auth::user()->role == 'kepalalab') {
            $data_penerima_peminjaman = Peminjaman::with('peminjam')
                ->where('idpeminjam', $idpeminjam)
                ->whereHas('peminjam', function ($query) {
                    $query->where('status', 'menunggu');
                })
                ->get();

            return view('kepalalab.datapeminjaman.detail', compact('data_penerima_peminjaman'));
        } else {
            return redirect('/')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }


    public function approve($idpeminjam)
    {
        try {
            // Temukan peminjam berdasarkan ID
            $peminjam = Peminjam::findOrFail($idpeminjam);

            // Mulai transaksi database
            DB::beginTransaction();

            try {
                // Ubah status peminjam menjadi 'disetujui'
                $peminjam->status = 'disetujui';
                $peminjam->save();

                // Loop through each peminjaman and update the related barang
                foreach ($peminjam->peminjamans as $peminjamanDetail) {
                    // Dapatkan idbarang dan idkategori dari setiap peminjaman
                    $idbarang = $peminjamanDetail->idbarang;
                    $idkategori = $peminjamanDetail->idkategori;

                    // Cek statusbarang pada tabel barang
                    $statusBarang = Barang::where('idbarang', $idbarang)
                        ->where('idkategori', $idkategori)
                        ->value('statusbarang');

                    if ($statusBarang === 'tidak_tersedia') {
                        // Rollback transaksi jika barang tidak tersedia
                        DB::rollback();
                        return redirect()->route('datapeminjaman.kepalalab')->with('error', 'Barang dengan ID ' . $idbarang . ' tidak tersedia, masih dalam peminjaman.');
                    }

                    // Update enum statusbarang menjadi 'tidak_tersedia' pada tabel barang
                    Barang::where('idbarang', $idbarang)
                        ->where('idkategori', $idkategori)
                        ->update(['statusbarang' => 'tidak_tersedia']);

                    // Buat catatan di Riwayatpeminjam dengan menyertakan idpeminjaman
                    $riwayat = new Riwayatpeminjam();
                    $riwayat->idkategori = $idkategori;
                    $riwayat->idpeminjam = $peminjam->idpeminjam;
                    $riwayat->idpeminjaman = $peminjamanDetail->idpeminjaman;
                    $riwayat->idbarang = $idbarang;
                    $riwayat->statusbarang = 'dipinjam';
                    $riwayat->save();
                }

                // Commit the transaction
                DB::commit();

                // Redirect atau kembali ke view to-be-approved
                return redirect()->route('datapeminjaman.kepalalab')->with('success', 'Peminjaman berhasil disetujui.');
            } catch (\Exception $e) {
                // Rollback the transaction if any exception occurs
                DB::rollback();

                // Handle the exception as needed
                return redirect()->route('datapeminjaman.kepalalab')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            // Handle the exception as needed
            return redirect()->route('datapeminjaman.kepalalab')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function reject($idpeminjam)
    {
        // Temukan peminjam berdasarkan ID
        $peminjam = peminjam::findOrFail($idpeminjam);

        // Ubah status peminjam menjadi 'ditolak'
        $peminjam->status = 'ditolak';
        $peminjam->save();

        // Hapus data peminjaman yang terkait dengan peminjam
        $peminjam->peminjamans()->delete();

        // Redirect atau kembali ke view to-be-approved
        return redirect()->route('datapeminjaman.kepalalab');
    }
}
