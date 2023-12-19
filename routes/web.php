<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Kategoricontroller;
use App\Http\Controllers\barangcontroller;
use App\Http\Controllers\peminjamancontroller;
use App\Http\Controllers\peminjamcontroller;
use App\Http\Controllers\RiwayatpeminjamController;
use App\Http\Controllers\datapeminjamancontroller;
use App\Http\Controllers\lokasicontroller;
use App\Http\Controllers\lokasibarangcontroller;
use App\Models\lokasibarang;

Route::view('/', 'welcome');

/*Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');*/

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'staff'])
    ->group(function () {
        Route::get('/kategori/role', [KategoriController::class, 'role'])->name('kategori.role');
        Route::post('/kategori', [KategoriController::class, 'post'])->name('kategori.post');
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.staff');
        Route::delete('/kategori/{kategori}/hapus', [KategoriController::class, 'hapus'])->name('kategori.hapus');
        Route::put('/kategori/update/{idkategori}', [KategoriController::class, 'update'])->name('kategori.update');
        // barang
        Route::get('/barang/role', [barangController::class, 'role'])->name('barang.role');
        Route::get('/barang', [barangController::class, 'index'])->name('barang.staff');
        Route::get('/barang/cetak', [barangController::class, 'indexcetak'])->name('barangcetak.staff');
        Route::get('/barang/{idbarang}/detail', [barangController::class, 'indexdetail'])->name('barangdetail.staff');
        Route::get('/barangtersedia', [barangController::class, 'tersedia'])->name('tersedia.staff');
        Route::post('/barang', [barangController::class, 'post'])->name('barang.post');
        Route::delete('/barang/{barang}/hapus', [BarangController::class, 'hapus'])->name('barang.hapus');
        Route::put('/barang/update/{idbarang}', [barangController::class, 'update'])->name('barang.update');
        // peminjaman
        Route::get('/peminjaman/role', [PeminjamanController::class, 'role'])->name('peminjaman.role');
        Route::get('/peminjaman/{idpeminjam}', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/cetakpdf/{idpeminjaman}/{idpeminjam}', [PeminjamanController::class, 'cetakpdf'])->name('peminjaman.cetakpdf');
        Route::delete('/peminjaman/{peminjaman}/hapus', [peminjamanController::class, 'hapus'])->name('peminjaman.hapus');
        Route::post('/peminjaman', [PeminjamanController::class, 'tambah'])->name('peminjaman.tambah');
        Route::get('/peminjaman/create/{idpeminjam}', [PeminjamanController::class, 'createFormPeminjaman'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'post'])->name('peminjaman.post');
        Route::post('/peminjaman/selesai/{idpeminjam}', [PeminjamanController::class, 'selesaipeminjaman'])->name('peminjaman.selesai');
        // peminjam
        Route::get('/peminjam/role', [peminjamController::class, 'role'])->name('peminjam.role');
        Route::get('/peminjam', [peminjamController::class, 'index'])->name('peminjam.staff');
        Route::get('/peminjam/cetak', [peminjamController::class, 'indexcetak'])->name('peminjamcetak.staff');
        Route::get('/peminjam/cetakpdf/{idpeminjam}', [peminjamController::class, 'cetakpdf'])->name('peminjam.cetakpdf');
        Route::post('/peminjam', [peminjamController::class, 'post'])->name('peminjam.post');
        Route::delete('/peminjam/{peminjam}/hapus', [peminjamController::class, 'hapus'])->name('peminjam.hapus');
        Route::put('/peminjam/update/{idpeminjam}', [peminjamController::class, 'update'])->name('peminjam.update');
        // Riwayatbarang
        Route::get('/Riwayatbarang/role', [peminjamController::class, 'role'])->name('riwayatbarang.role');
        Route::get('/Riwayatpeminjam', [RiwayatpeminjamController::class, 'index'])->name('riwayatpeminjam.index');
        Route::delete('/riwayatpeminjam/{riwayatpeminjam}', 'RiwayatPeminjamController@hapus')->name('riwayatpeminjam.hapus');
        Route::put('/edit/kondisi/{idbarang}', [Riwayatpeminjamcontroller::class, 'editkondisi'])->name('edit.kondisi');
        Route::get('staff/riwayat/riwayatpeminjam/{idpeminjam}', [RiwayatpeminjamController::class, 'detail'])->name('staff.riwayat.riwayatbarang');
        // lokasi
        Route::get('/lokasi/role', [lokasiController::class, 'role'])->name('lokasi.role');
        Route::get('/lokasi', [lokasiController::class, 'index'])->name('lokasi.staff');
        Route::post('/lokasi', [LokasiController::class, 'post'])->name('lokasi.post');
        Route::put('/lokasi/update/{idlokasi}', [lokasiController::class, 'update'])->name('lokasi.update');
        Route::delete('/lokasi/{lokasi}/hapus', [LokasiController::class, 'hapus'])->name('lokasi.hapus');
        Route::get('/lokasibarang/role', [lokasibarangController::class, 'role'])->name('lokasibarang.role');
        // lokasibarang
        Route::get('/lokasibarang/{idlokasi}', [lokasibarangController::class, 'index'])->name('lokasibarang.staff');
        Route::post('/lokasibarang', [LokasibarangController::class, 'post'])->name('lokasibarang.post');
        Route::delete('/lokasibarang/hapus/{idlokasibarang}', [LokasiBarangController::class, 'hapus'])->name('lokasibarang.hapus');
    });


Route::middleware(['auth', 'kepalalab'])
    ->group(function () {
        Route::get('/datapeminjaman', [datapeminjamanController::class, 'dataToBeApproved'])->name('datapeminjaman.kepalalab');
        Route::get('/peminjaman/approve/{idpeminjam}', [datapeminjamanController::class, 'approve'])->name('peminjaman.approve');
        Route::get('/datapeminjaman/reject/{idpeminjam}', [dataPeminjamanController::class, 'reject'])->name('peminjaman.reject');
        Route::get('/kepalalab/datapeminjaman/detail/{idpeminjam}/{idpeminjaman}', [DatapeminjamanController::class, 'detailPeminjaman'])->name('kepalalab.datapeminjaman.detail');

        Route::get('/barangkepalalab', [barangController::class, 'indexkepalalab'])->name('barang.kepalalab');
        Route::get('/Riwayatpeminjamkepalalab', [RiwayatpeminjamController::class, 'indexkepalalab'])->name('riwayatpeminjam.kepalalab');
        Route::get('kepalalab/riwayat/riwayatpeminjam/{idpeminjam}', [RiwayatpeminjamController::class, 'detailkepalalab'])->name('kepalalab.riwayat.riwayatbarang');
    });

// Route::middleware(['auth', 'kepalalab'])
//     ->group(function () {
//         Route::get('/barang/role', [barangController::class, 'role'])->name('barang.role');
//         Route::get('/barangkepalalab', [barangController::class, 'indexkepalalab'])->name('barang.kepalalab');
//         Route::get('/barangtersediakepalalab', [barangController::class, 'tersediakepalalab'])->name('tersedia.keplalab');
//         Route::post('/barangkeplalab', [barangController::class, 'post'])->name('barang.post');
//         Route::delete('/barangkepalalab/{barang}/hapus', [BarangController::class, 'hapus'])->name('barang.hapus');
//         Route::put('/barangkepalalab/update/{idbarang}', [barangController::class, 'update'])->name('barang.update');
//     });

require __DIR__ . '/auth.php';
