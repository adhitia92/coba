{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris Lab</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets//plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets//dist/css/adminlte.min.css') }}">
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>
    <script>
        \
        Carbon\ Carbon::setLocale('id');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link rel="icon" href="{{ asset('assets/dist/img/logounib.png') }}" type="image/png">


</head>
<style>
    .modal-content {
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        background: linear-gradient(to right, #3cb1ff, rgb(58, 153, 247));
        /* Gradien warna latar belakang */
        color: #fff;
    }

    .modal-title {
        font-size: 24px;
        font-weight: bold;
    }

    .modal-label {
        font-size: 18px;
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #3498db;
        border-radius: 8px;
        color: #333;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #2ecc71;
        box-shadow: 0 0 0 0.2rem rgba(46, 204, 113, 0.25);
    }

    .modal-footer {
        background: linear-gradient(to right, #3cb1ff, rgb(58, 153, 247));
        /* Gradien warna latar belakang footer */
        border-top: 1px solid #fff;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #2ecc71;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #2ecc71;
        color: #fff;
    }

    .btn-info:hover {
        background-color: #2ecc71;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #2ecc48;
        color: #fff;
    }

    .modal-content [readonly],
    .modal-content [readonly].form-control {
        background-color: #a1a1a1;
        opacity: 1;
    }

    .visually-disabled {
        cursor: not-allowed;
    }
    .sidebar .nav-item {
    margin-bottom: 5px;
    }
</style>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('assets/dist/img/logounib.png ') }}" alt="AdminLTE Logo "
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Inventaris Lab</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('assets/dist/img/logouser.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('kategori.staff') }}" class="nav-link">
                                <i class="nav-icon fas fa-shapes"></i>
                                <p>
                                    Kategori Barang
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('barang.staff') }}"
                                class="nav-link {{ Request::is('barang*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>
                                    Daftar Barang
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-feather"></i>
                                <p>
                                    Transaksi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('tersedia.staff') }}" class="nav-link">
                                        <i class="fas fa-list-ul"></i>
                                        <p>Barang Tersedia</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('peminjam.staff') }}" class="nav-link">
                                        <i class="fas fa-file-invoice"></i>
                                        <p>Peminjaman Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('riwayatpeminjam.index') }}" class="nav-link">
                                        <i class="fas fa-indent"></i>
                                        <p>Riwayat Peminjaman</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lokasi.staff') }}" class="nav-link">
                                <i class="fas fa-door-closed"></i>
                                <p>
                                    Lokasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    class="nav-link"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <p>
                                        Logout
                                    </p>
                                </a>
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Kategori</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DAFTAR BARANG</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: '{{ $message }}',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            </script>
                        @endif

                        @if ($error = Session::get('error'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: '{{ $error }}',
                                    showConfirmButton: true,
                                    confirmButtonText: 'OK'
                                });
                            </script>
                        @endif
                        <div class="box-body">
                            <div class="container">
                                <button style="margin-bottom: 20px; width: 150px; height: 40px; border-radius: 20px;"
                                    data-toggle="modal" data-target="#myModal" class="btn btn-info"><span
                                        class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
                                        <table id="datatabel" class="table table-striped table-bordered" style="width:100%">
                                            <thead style="background-color: rgba(27, 145, 255, 0.726); color: rgb(0, 0, 0);">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Foto Barang</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Kondisi</th>
                                                    <th>Asal Barang</th>
                                                    <th>Status  Peminjaman</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                @foreach ($data_barang_kategori as $items)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>
                                                            @if($items->gambar)
                                                                <img src="{{ asset('storage/gambar_barang/' . basename($items->gambar)) }}" alt="Foto Barang" style="max-width: 100px; max-height: 80px;">
                                                            @else
                                                                <!-- Tambahkan gambar default jika gambar tidak tersedia -->
                                                                <img src="{{ asset('path/ke/gambar/default.jpg') }}" alt="Foto Barang Default" style="max-width: 100px; max-height: 80px;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $items->kodebarcode }}</td>
                                                        <td>{{ $items->namakategori }} {{ $items->jenis }} {{ $items->merk }}</td>
                                                        <td class="{{ strcasecmp($items->kondisi, 'rusak') === 0 ? 'text-danger' : (strcasecmp($items->kondisi, 'rusak_ringan') === 0 ? 'text-warning' : 'text-success') }}">
                                                            {{ $items->kondisi }}
                                                        </td>
                                                        <td>{{ $items->asal }}</td>
                                                        <td class="{{ $items->statusbarang == 'tersedia' ? 'text-success' : 'text-danger' }}">
                                                            {{ $items->statusbarang }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($items->barang_created_at)->formatLocalized('%A, %d %B %Y %H:%M') }}</td>
                                                        <td>
                                                            <div style="display: flex; justify-content: space-around; align-items: center;">
                                                                <button data-toggle="modal" data-target="#modaledit_{{ $items->idbarang }}" class="btn btn-warning">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>

                                                                <button class="btn btn-danger" data-toggle="modal" data-target="#modaldelete_{{ $items->idbarang }}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>

                                                                <a href="{{ route('barangdetail.staff', ['idbarang' => $items->idbarang]) }}" class="btn btn-primary"s>
                                                                    <i class="fas fa-info"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <a href="{{ route ('barangcetak.staff')}}" class="btn btn-primary">
                                            <i class="fas fa-print"> CETAK DATA</i>
                                        </a>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2023 INVENTARIS LAB INFORMATIKA</a>.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <!-- modal-->

    @if (!empty($items))
        @foreach ($data_barang_kategori as $item)
            <!-- Modal Edit -->
            <div id="modaledit_{{ $item->idbarang }}" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data Barang</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('barang.update', ['idbarang' => $item->idbarang]) }}" novalidate enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="idbarang" value="{{ $item->idbarang }}">
                                <div class="form-group">
                                    <label class="modal-label" for="selected-idbarang">Pilih Barang</label>
                                    <select name="selected_idbarang" id="selected-idbarang" class="form-control" required>
                                        <option value="">Pilih Barang</option>
                                        @foreach ($kombinasilist as $barang)
                                            <option value="{{ $barang->idbarang }}"
                                                data-idkategori="{{ $barang->kategori->idkategori }}"
                                                data-jumlah="{{ $barang->jumlah }}"
                                                data-idbarang="{{ $barang->idbarang }}"
                                                data-namakategori="{{ $barang->kategori->namakategori }}"
                                                data-jenis="{{ $barang->kategori->jenis }}"
                                                data-merk="{{ $barang->kategori->merk }}"
                                                data-kondisi="{{ $barang->kondisi }}"
                                                {{ $item->idbarang == $barang->idbarang ? 'selected' : '' }}>
                                                ({{ $barang->idbarang }})
                                                {{ $barang->kategori->namakategori }} - {{ $barang->kategori->jenis }}
                                                -
                                                {{ $barang->kategori->merk }} - {{ $barang->kondisi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit-asal" class="modal-label">Asal Barang</label>
                                    <input type="text" id="edit-asal" name="asal" value="{{ $item->asal }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label" for="kondisi">Kondisi Barang</label>
                                    <select name="kondisi" id="kondisi" class="form-control" required>
                                        <option value="baik" {{ $item->kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="rusak" {{ $item->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label" for="statusbarang">Status Barang</label>
                                    <select name="statusbarang" id="statusbarang" class="form-control" required>
                                        <option value="tersedia" {{ $item->statusbarang == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="tidak_tersedia" {{ $item->statusbarang == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="edit-created-at" class="modal-label">Tanggal Masuk</label>
                                    <input type="datetime-local" id="edit-created-at" name="created_at"
                                        value="{{ \Carbon\Carbon::parse($item->barang_created_at)->format('Y-m-d\TH:i') }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="modal-label" for="edit-gambar">Gambar Barang</label>
                                    <input type="file" name="gambar" id="edit-gambar" class="form-control-file">
                                </div>

                                @if($item->gambar)
                                    <div class="form-group">
                                        <label class="modal-label">Gambar Saat Ini</label>
                                        <img src="{{ asset('storage/gambar_barang/' . basename($item->gambar)) }}" alt="Gambar Barang" style="max-width: 100px;">
                                    </div>
                                @endif

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Delete -->
            <div class="modal fade" id="modaldelete_{{ $item->idbarang }}" tabindex="-1" role="dialog"
                aria-labelledby="modaldelete_{{ $item->idbarang }}Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modaldelete_{{ $item->idbarang }}Label">Konfirmasi
                                penghapusan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Anda yakin ingin menghapus data barang ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            <form action="{{ route('barang.hapus', ['barang' => $item->idbarang]) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-danger" style="text-align: center">
            Tidak ada data Barang.
        </div>
    @endif


    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TAMBAH DATA BARANG</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" id="myForm" action="{{ route('barang.post') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="modal-label" for="idkategori">Pilih Kategori</label>
                            <select name="idkategori" id="idkategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategorilist as $kategori)
                                    <option value="{{ $kategori->idkategori }}">{{ $kategori->namakategori }} -
                                        {{ $kategori->jenis }} - {{ $kategori->merk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="modal-label" for="kondisi">Kondisi Barang</label>
                            <select name="kondisi" id="kondisi" class="form-control" required>
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="modal-label" for="asal">Asal Barang</label>
                            <input name="asal" id="asal" type="text" autocomplete="off" class="form-control" placeholder="Asal Barang" required>
                        </div>

                        <div class="form-group">
                            <label class="modal-label" for="created_at">Tanggal Masuk</label>
                            <input type="datetime-local" class="form-control" id="created_at" name="created_at" required
                                   value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
                        </div>

                        <div class="form-group">
                            <label class="modal-label" for="gambar">Gambar Barang</label>
                            <input type="file" name="gambar" id="gambar" class="form-control-file">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- ./wrapper -->

    <!-- jQuery -->
    <script>
        $(document).ready(function() {
            $('#modaledit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var idbarang = button.data('idbarang');
                var namakategori = button.data('namakategori');
                var jenis = button.data('jenis');
                var merk = button.data('merk');
                var kondisi = button.data('kondisi');
                var asal = button.data('asal');
                var created_at = button.data('created-at');

                var modal = $(this);
                modal.find('#edit-idbarang').val(idbarang);
                modal.find('#edit-nama-kategori').val(namakategori);
                modal.find('#edit-jenis').val(jenis);
                modal.find('#edit-merk').val(merk);
                modal.find('#edit-kondisi').val(kondisi);
                modal.find('#edit-asal').val(asal);
                modal.find('#edit-created-at').val(created_at);
            });
        });
    </script>

    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            var idkategori = document.getElementById('idkategori').value;
            var kondisi = document.getElementById('kondisi').value;
            var asal = document.getElementById('asal').value;
            var created_at = document.getElementById('created_at').value;

            if (!idkategori || !kondisi || !asal || !created_at) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data Harus Diisi!',
                });

                event.preventDefault(); // Prevent form submission
            }
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.btn-edit').on('click', function() {
                var idbarang = $(this).data('idbarang');
                $('#modaledit_' + idbarang).modal('show');
            });
        });
    </script>

    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-4h+BRmBl5S9WJotZIv6KGanRgDFGg/M93ba8zRVcqsILwvCWpR9tC6zW+oRb26qJ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-rfIEsHV2RvU9z4uZDf1eIHsj4nAjQ0d30z5fS4U9LjPi3ecSQ3xqC2CMEZ7gxzVo" crossorigin="anonymous">
    </script>

    <!-- DataTables Initialization Script -->
    <script>
        $(document).ready(function() {
            $('#datatabel').DataTable({
                dom: 'Bfrtip',
                buttons: ['print']
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.btn-edit').on('click', function() {
                var idbarang = $(this).data('idbarang');
                $('#modaledit_' + idbarang).modal('show');
            });
        });
    </script>


    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
</body>

</html>
