<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\View;
use App\Models\peminjam;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Riwayatpeminjam;
use App\Models\BarangMasuk;

class PeminjamanController extends Controller
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
    public function index(Request $request, $idpeminjam)
    {
        // Cek apakah $idpeminjam ada atau tidak
        if (!$idpeminjam) {
            abort(404); // Tampilkan halaman error 404 jika $idpeminjam tidak ada
        }

        // Lanjutkan dengan mengambil data kategori dan barang
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();

        // Combine kategorilist and baranglist into one collection
        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        // Ambil data peminjaman berdasarkan idpeminjam
        $data_peminjaman = DB::table('peminjaman')
            ->join('kategori', 'kategori.idkategori', '=', 'peminjaman.idkategori')
            ->join('barang', 'barang.idbarang', '=', 'peminjaman.idbarang')
            ->join('peminjam', 'peminjam.idpeminjam', '=', 'peminjaman.idpeminjam')
            ->select(
                'peminjaman.idpeminjaman',
                'peminjam.idpeminjam',
                'barang.idbarang',
                'kategori.namakategori as namakategori',
                'kategori.jenis as jenis',
                'kategori.merk as merk',
                'barang.kondisi',
                'barang.asal',
                'kategori.jenis',
                'peminjam.kontak',
                'peminjam.namapeminjam',
                'peminjam.kontak',
                'peminjam.created_at',
                'barang.kodebarcode',
                'barang.gambar',
                'peminjam.instansi',
                'peminjam.status',
                'peminjam.keterangan'
            )
            ->where('peminjaman.idpeminjam', $idpeminjam) // Filter data berdasarkan idpeminjam
            ->get();

        // Ambil data peminjam berdasarkan idpeminjam
        $data_peminjam = peminjam::with('peminjamans')->findOrFail($idpeminjam);

        // Ambil data peminjam untuk dropdown
        $peminjamlist = peminjam::all();

        return view('staff.peminjaman.index', compact('data_peminjaman', 'kombinasilist', 'data_peminjam', 'peminjamlist'));
    }


    public function cetakpdf($idpeminjaman, $idpeminjam)
    {
        try {
            $data_peminjaman = Peminjaman::with(['barang.kategori', 'peminjam'])
                ->where('idpeminjaman', $idpeminjaman)
                ->orWhere('idpeminjam', $idpeminjam)
                ->first();

            if (!$data_peminjaman) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $data = [
                'data_peminjaman' => $data_peminjaman,
            ];

            $pdf = PDF::loadView('pdf_peminjaman', $data);

            return $pdf->stream('document.pdf');
        } catch (\Exception $e) {
            logger('Error in cetakpdf: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }


        public function hapus($idpeminjaman)
        {
            try {
                // Find the peminjaman by its ID
                $peminjaman = Peminjaman::findOrFail($idpeminjaman);

                // Get the related peminjam ID before deletion
                $idpeminjam = $peminjaman->idpeminjam;

                // Delete the peminjaman
                $peminjaman->delete();

                return redirect()->route('peminjaman.index', ['idpeminjam' => $idpeminjam])->with('success', 'Data berhasil dihapus');
            } catch (\Exception $e) {
                // Handle any exception that occurs
                return redirect()->back()->with('error', 'Gagal menghapus data. Silakan coba lagi.');
            }
        }


        public function post(Request $request)
{
    $request->validate([
        'idkategori' => 'required',
        'idpeminjam' => 'required',
        'idbarang' => 'required',
    ]);

    try {
        // Ambil data peminjam
        $peminjam = Peminjam::findOrFail($request->idpeminjam);

        // Jika kode barcode dari modal diisi, gunakan nilai tersebut, selain itu gunakan nilai dari dropdown
        $kodeBarcode = $request->filled('kodebarcode_modal') ? $request->kodebarcode_modal : $request->idbarang;

        // Ambil data barang
        $barang = Barang::where('kodeBarcode', $kodeBarcode)->first();

        // Cek apakah barang sudah dipinjam oleh peminjam
        if ($peminjam->peminjamans()->where('idbarang', $barang->idbarang)->exists()) {
            // Barang sudah dipinjam, berikan pesan error
            return redirect()->route('peminjaman.index', ['idpeminjam' => $peminjam->idpeminjam])->with(['error' => 'Barang sudah ada dalam form.']);
        }

        // Simpan data peminjaman ke database
        $datapeminjaman = new Peminjaman();
        $datapeminjaman->idkategori = $request->idkategori; // Sesuaikan dengan kebutuhan Anda
        $datapeminjaman->idbarang = $barang->idbarang;
        $datapeminjaman->idpeminjam = $peminjam->idpeminjam;

        $datapeminjaman->save();

        // Redirect ke peminjaman.index dengan menyertakan idpeminjam yang dipilih
        return redirect()->route('peminjaman.index', ['idpeminjam' => $peminjam->idpeminjam])->with('success', 'Data berhasil ditambahkan');
    } catch (\Exception $e) {
        // Log the error
        Log::error('Error saving data: ' . $e->getMessage(), [
            'request_data' => $request->all(),
            'trace' => $e->getTrace(),
        ]);

        // Debugging: Print the error message
        dd($e->getMessage());

        // Handle kesalahan jika terjadi
        return redirect()->route('peminjaman.index', ['idpeminjam' => $peminjam->idpeminjam])->with(['error' => 'Gagal menyimpan data. Silakan cek log untuk informasi lebih lanjut.']);
    }
}



        public function selesaiPeminjaman($idpeminjam)
        {
            try {
                // Temukan peminjam berdasarkan ID
                $peminjam = Peminjam::findOrFail($idpeminjam);

                // Mulai transaksi database
                DB::beginTransaction();

                // Ambil semua peminjaman yang terkait dengan peminjam
                $peminjamans = $peminjam->peminjamans;

                try {
                    // Loop melalui setiap peminjaman
                    foreach ($peminjamans as $peminjaman) {
                        // Dapatkan idbarang dari peminjaman
                        $idbarang = $peminjaman->idbarang;

                        // Ubah statusbarang menjadi 'tersedia' di tabel barang
                        Barang::where('idbarang', $idbarang)->update(['statusbarang' => 'tersedia']);

                        // Ubah statusbarang menjadi 'dikembalikan' di tabel riwayatpeminjaman
                        Riwayatpeminjam::where('idpeminjaman', $peminjaman->idpeminjaman)
                            ->update(['statusbarang' => 'dikembalikan']);
                    }

                    // Commit transaksi
                    DB::commit();

                    // Redirect atau kembali ke view yang sesuai
                    return redirect()->back()->with('success', 'Peminjaman selesai.');
                } catch (\Exception $e) {
                    // Rollback transaksi jika terjadi kesalahan
                    DB::rollback();

                    // Redirect atau kembali ke view dengan pesan kesalahan
                    return redirect()->back()->with('error', 'Gagal menyelesaikan peminjaman. Silakan coba lagi.');
                }
            } catch (\Exception $e) {
                // Handle the exception as needed
                return redirect()->back()->with('error', 'Gagal menyelesaikan peminjaman. Silakan coba lagi.');
            }
        }
}

