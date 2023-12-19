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

    .content {
        padding: 20px;
    }

    /* Style the card container */
    .custom-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease;
        background-color: #fff; /* Card background color */
    }

    /* Hover effect for the card */
    .custom-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Style the image container */
    .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 100%;
        overflow: hidden;
        border-bottom: 1px solid #ddd;
    }

    .image-container img {
        max-width: 100%;
        max-height: 400px; /* Adjust the maximum height as needed */
        height: auto;
        margin-left: 10px; /* Adjust the margin-left as needed */
    }


    /* Style the card body */
    .card-body {
        padding: 15px;
    }

    /* Style the card title */
    .card-title {
        font-size: 1.5em;
        margin-bottom: 10px;
        color: #fff; /* Text color for card title */
        background-color: #007bff; /* Background color for card title */
        padding: 10px; /* Adjust the padding as needed */
        border-radius: 8px; /* Add some border-radius for a rounded appearance */
    }

    /* Style the card text */
    .card-text {
        margin-bottom: 8px;
        color: #666;
    }

    /* Style the explanation container */
    .explanation-container {
        padding: 15px;
        border-top: 1px solid #ddd;
        color: #333;
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
                <div class="container">
                    <div class="row">
                        @foreach ($data_barang_kategori as $items)
                            <div >
                                <div class="card custom-card h-100 d-flex flex-row">
                                    <div class="image-container">
                                        <img src="{{ $items->gambar ? asset('storage/gambar_barang/' . basename($items->gambar)) : asset('path/ke/gambar/default.jpg') }}" class="card-img-top" alt="Foto Barang">
                                    </div>
                                    <div class="card-body flex-grow-1">
                                        <h5 class="card-title">{{ $items->namakategori }} {{ $items->jenis }} {{ $items->merk }}</h5>
                                        <p class="card-text">Kode Barang: {!! DNS1D::getBarcodeHTML($items->kodebarcode, 'C128', 2, 50) !!} P - {{ $items->kodebarcode }}</p>
                                        <p class="card-text">Kondisi: <span class="{{ strcasecmp($items->kondisi, 'rusak') === 0 ? 'text-danger' : (strcasecmp($items->kondisi, 'rusak_ringan') === 0 ? 'text-warning' : 'text-success') }}">{{ $items->kondisi }}</span></p>
                                        <p class="card-text">Asal Barang: {{ $items->asal }}</p>
                                        <p class="card-text">Status Peminjaman: <span class="{{ $items->statusbarang == 'tersedia' ? 'text-success' : 'text-danger' }}">{{ $items->statusbarang }}</span></p>
                                        <p class="card-text">Tanggal Masuk: {{ \Carbon\Carbon::parse($items->barang_created_at)->formatLocalized('%A, %d %B %Y %H:%M') }}</p>
                                    </div>
                                    <div class="explanation-container">
                                        <!-- Add your explanation content here -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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
