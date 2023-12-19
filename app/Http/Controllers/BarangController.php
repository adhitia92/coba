<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\riwayatbarang;
use App\Models\kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BarangController extends Controller
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
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();
        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        $data_barang_kategori = DB::table('barang')
            ->join('kategori', 'kategori.idkategori', '=', 'barang.idkategori')
            ->select(
                'barang.idbarang',
                'kategori.namakategori',
                'kategori.merk',
                'barang.kondisi',
                'barang.kodebarcode',
                'barang.gambar',
                'barang.asal',
                'barang.statusbarang',
                'kategori.jenis',
                'barang.created_at as barang_created_at'
            )
            ->get();

        return view('staff.barang.index', compact('data_barang_kategori', 'kategorilist','kombinasilist'));
    }

    public function indexcetak()
    {
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();
        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        $data_barang_kategori = DB::table('barang')
            ->join('kategori', 'kategori.idkategori', '=', 'barang.idkategori')
            ->select(
                'barang.idbarang',
                'kategori.namakategori',
                'kategori.merk',
                'barang.kondisi',
                'barang.kodebarcode',
                'barang.gambar',
                'barang.asal',
                'barang.statusbarang',
                'kategori.jenis',
                'barang.created_at as barang_created_at'
            )
            ->get();

        return view('staff.barang.cetak', compact('data_barang_kategori', 'kategorilist','kombinasilist'));
    }

    public function indexdetail($idbarang)
    {
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();

        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        $data_barang_kategori = DB::table('barang')
            ->join('kategori', 'kategori.idkategori', '=', 'barang.idkategori')
            ->select(
                'barang.idbarang',
                'kategori.namakategori',
                'kategori.merk',
                'barang.kondisi',
                'barang.kodebarcode',
                'barang.gambar',
                'barang.asal',
                'barang.statusbarang',
                'kategori.jenis',
                'barang.created_at as barang_created_at'
            )
            ->where('barang.idbarang', $idbarang) // Filter by idbarang
            ->get();

        return view('staff.barang.detail', compact('data_barang_kategori', 'kategorilist', 'kombinasilist'));
    }

    public function indexkepalalab()
    {
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();

        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        $data_barang_kategori = DB::table('barang')
            ->join('kategori', 'kategori.idkategori', '=', 'barang.idkategori')
            ->select(
                'barang.idbarang',
                'kategori.namakategori',
                'kategori.merk',
                'barang.kondisi',
                'barang.kodebarcode',
                'barang.gambar',
                'barang.asal',
                'barang.statusbarang',
                'kategori.jenis',
                'barang.created_at as barang_created_at'
            )
            ->get();

        return view('kepalalab.barang.index', compact('data_barang_kategori', 'kategorilist','kombinasilist'));
    }

    public function tersediakepalalab()
    {
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();

        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        $data_barang_kategori = DB::table('barang')
            ->join('kategori', 'kategori.idkategori', '=', 'barang.idkategori')
            ->where('barang.statusbarang', 'tersedia')
            ->where('barang.kondisi', 'baik')
            ->select(
                'barang.idbarang',
                'kategori.namakategori',
                'kategori.merk',
                'barang.kondisi',
                'barang.asal',
                'barang.statusbarang',
                'kategori.jenis',
                'barang.created_at as barang_created_at'
            )
            ->get();

        return view('kepalalab.barang.tersedia', compact('data_barang_kategori', 'kategorilist', 'kombinasilist'));
    }
    public function tersedia()
    {
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();

        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        $data_barang_kategori = DB::table('barang')
            ->join('kategori', 'kategori.idkategori', '=', 'barang.idkategori')
            ->where('barang.statusbarang', 'tersedia')
            ->where('barang.kondisi', 'baik')
            ->select(
                'barang.idbarang',
                'kategori.namakategori',
                'kategori.merk',
                'barang.kondisi',
                'barang.kodebarcode',
                'barang.gambar',
                'barang.asal',
                'barang.statusbarang',
                'kategori.jenis',
                'barang.created_at as barang_created_at'
            )
            ->get();

        return view('staff.barang.tersedia', compact('data_barang_kategori', 'kategorilist', 'kombinasilist'));
    }

    public function post(Request $request)
    {
        $request->validate([
            'idkategori' => 'required',
            'kondisi' => 'required|in:baik,rusak',
            'asal' => 'required',
            'created_at' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barang = new Barang();
        $barang->idkategori = $request->idkategori;
        $barang->kondisi = $request->kondisi;
        $barang->asal = $request->asal;
        $barang->created_at = $request->created_at;

        $numericBarcode = mt_rand(100000000000, 999999999999);

        while (Barang::where('kodebarcode', $numericBarcode)->exists()) {
            $numericBarcode = mt_rand(100000000000, 999999999999);
        }

        $barang->kodebarcode = $numericBarcode;

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambarFile = $request->file('gambar');

            $gambarFileName = date('YmdHis') . '_' . Str::random(5) . '.' . $gambarFile->getClientOriginalExtension();

            $gambarPath = $gambarFile->storeAs('public/gambar_barang', $gambarFileName);
            $gambarUrl = Storage::url($gambarPath);

            $barang->gambar = $gambarUrl;
        }

        $barang->save();

        return redirect()->route('barang.staff')->with(['success' => 'Data berhasil disimpan!']);
    }


    public function hapus(Barang $barang)
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Hapus gambar (jika ada)
            if ($barang->gambar) {
                Storage::delete('public/gambar_barang/' . basename($barang->gambar));
            }

            // Hapus barang jika tidak ada referensi di tabel riwayatbarang
            $barang->delete();

            // Commit transaksi
            DB::commit();

            return redirect()->route('barang.staff')->with('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            return redirect()->route('barang.staff')->with('error', 'Gagal menghapus barang. Silakan coba lagi.');
        }
    }


    public function update(Request $request, $idbarang)
    {
        $request->validate([
            'selected_idbarang' => 'required',
            'asal' => 'required',
            'kondisi' => 'required',
            'statusbarang' => 'required',
            'created_at' => 'required|date_format:Y-m-d\TH:i',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barang = Barang::find($idbarang);

        if (!$barang) {
            return redirect()->route('barang.staff')->with('error', 'Data barang tidak ditemukan.');
        }

        $selectedBarang = Barang::find($request->input('selected_idbarang'));

        if (!$selectedBarang) {
            return redirect()->route('barang.staff')->with('error', 'Barang yang dipilih tidak ditemukan.');
        }

        // Update data barang
        $barang->idkategori = $selectedBarang->idkategori;
        $barang->kondisi = $request->input('kondisi');
        $barang->statusbarang = $request->input('statusbarang');
        $barang->asal = $request->input('asal');
        $barang->created_at = Carbon::parse($request->input('created_at'));

        // Update gambar jika ada file yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama (jika ada)
            if ($barang->gambar) {
                Storage::delete('public/gambar_barang/' . $barang->gambar);
            }

            // Upload gambar baru
            $gambarFile = $request->file('gambar');
            $gambarFileName = time() . '_' . $gambarFile->getClientOriginalName();
            $gambarFile->storeAs('public/gambar_barang', $gambarFileName);
            $barang->gambar = $gambarFileName;
        }

        // Simpan perubahan
        $barang->save();

        return redirect()->route('barang.staff')->with('success', 'Data barang berhasil diupdate.');
    }

}
