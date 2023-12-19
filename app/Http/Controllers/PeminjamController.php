<?php


namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\peminjam;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;


class peminjamController extends Controller
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

    public function index()
    {
        $data_peminjam = peminjam::all();
        return view('staff.peminjam.index', compact('data_peminjam'));
    }

    public function indexcetak()
    {
        $data_peminjam = peminjam::all();
        return view('staff.peminjam.cetak', compact('data_peminjam'));
    }
    public function cetakpdf($idpeminjam)
    {
        // Ambil data peminjam berdasarkan idpeminjam
        $data_peminjam = peminjam::findOrFail($idpeminjam);

        // Ambil data peminjaman terkait dengan peminjam
        $data_peminjaman = $data_peminjam->peminjamans;

        // Lakukan logika untuk mendapatkan data yang dibutuhkan
        // ...

        // Collecting peminjaman IDs
        $peminjamanIds = $data_peminjaman->pluck('idpeminjaman')->toArray();

        // Now you can use $peminjamanIds for further processing if needed

        // Buat objek PDF
        $pdf = PDF::loadView('pdf_peminjaman', compact('data_peminjaman'));

        // Tampilkan atau unduh PDF
        return $pdf->stream('nama_file.pdf');
    }

    public function post(Request $request)
    {
        $request->validate([
            'namapeminjam' => 'required',
            'kontak' => 'required',
            'instansi' => 'required',
            'keterangan' => 'required',
            'tanggalpengembalian' => 'required|date',
            'created_at' => 'required|date',
        ]);

        $dataPeminjam = new Peminjam();
        $dataPeminjam->id = Auth::id(); // Menggunakan Auth::id() untuk mengambil id user yang sedang login
        $dataPeminjam->namapeminjam = $request->namapeminjam;
        $dataPeminjam->kontak = $request->kontak;
        $dataPeminjam->instansi = $request->instansi;
        $dataPeminjam->keterangan = $request->keterangan;

        // Konversi tanggal ke objek Carbon
        $dataPeminjam->tanggalpengembalian = Carbon::parse($request->tanggalpengembalian);

        // Konversi tanggal ke objek Carbon
        $dataPeminjam->created_at = Carbon::parse($request->created_at);

        $dataPeminjam->save();

        return redirect()->route('peminjam.staff')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }

    public function update(Request $request, $idpeminjam)
    {
        // Validate request
        $request->validate([
            'namapeminjam' => 'required',
            'kontak' => 'required',
            'instansi' => 'required',
            'keterangan' => 'required',
            'tanggalpengembalian' => 'required|date_format:Y-m-d\TH:i',
            'created_at' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Temukan data peminjam berdasarkan ID
        $peminjam = Peminjam::find($idpeminjam);

        // Perbarui data Peminjam jika ditemukan
        if ($peminjam) {
            $peminjam->update([
                'namapeminjam' => $request->input('namapeminjam'),
                'kontak' => $request->input('kontak'),
                'instansi' => $request->input('instansi'),
                'keterangan' => $request->input('keterangan'),
                'tanggalpengembalian' => Carbon::parse($request->input('tanggalpengembalian')),
                'created_at' => Carbon::parse($request->input('created_at')),
            ]);

            return redirect()->route('peminjam.staff')->with('success', 'Data peminjam berhasil diupdate.');
        } else {
            return redirect()->route('peminjam.staff')->with('error', 'Data peminjam tidak ditemukan.');
        }
    }

    public function hapus($id)
    {
        try {
            $peminjam = Peminjam::findOrFail($id);
            $peminjam->delete();

            return redirect()->route('peminjam.staff')->with('success', 'Data peminjam berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('peminjam.staff')->with('error', 'Data gagal dihapus.');
        }
    }


}
