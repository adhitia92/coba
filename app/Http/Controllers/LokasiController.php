<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\lokasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
class LokasiController extends Controller
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
        $data_lokasi = lokasi::all();
        return view('staff.lokasi.index', compact('data_lokasi'));
    }

    public function post(Request $request)
        {
            $data_lokasi = new Lokasi();
            $data_lokasi->namalokasi = $request->namalokasi;
            $data_lokasi->created_at = $request->created_at;
            $data_lokasi->save();

            return redirect()->back()->with('success', 'Data lokasi berhasil disimpan.');
        }

    public function update(Request $request, $idlokasi)
    {
        // Validasi input form jika diperlukan
        $request->validate([
            'namalokasi' => 'required',
            'created_at' => 'required|date',
        ]);

        // Temukan lokasi berdasarkan ID
        $lokasi = Lokasi::find($idlokasi);

        // Update data lokasi
        $lokasi->namalokasi = $request->input('namalokasi');

        // Menggunakan Carbon untuk mengonversi string datetime menjadi instance Carbon
        $created_at = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('created_at'));
        $lokasi->created_at = $created_at;

        $lokasi->save();

        // Redirect ke halaman terkait atau tampilkan pesan sukses
        return redirect()->route('lokasi.staff')->with('success', 'Data Lokasi berhasil diperbarui.');
    }

    public function hapus(Lokasi $lokasi)
    {
        try {
            // Hapus lokasi
            $lokasi->delete();

            return redirect()->route('lokasi.staff')->with('success', 'Lokasi berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->route('lokasi.staff')->with('error', 'Gagal menghapus lokasi. Silakan coba lagi.');
        }
    }
}
