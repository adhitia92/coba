<html>

<head>
    <title>DAFTAR BARANG LAB TEKNIK INFORMATIKA</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <!-- Global site tag (gtag.js) - Google AnalytiSScs -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-144808195-1');
    </script>

</head>

<body>
    <div class="container">
        <h2>DAFTAR BARANG LAB TEKNIK INFORMATIKA</h2>
        <div class="data-tables datatable-dark">
            <table class="display" id="dataTable3" style="width:100%">
                <thead style="background-color: rgba(27, 145, 255, 0.726); color: rgb(0, 0, 0);">
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kondisi</th>
                        <th>Asal Barang</th>
                        <th>Status Peminjaman</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($data_barang_kategori as $items)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $items->kodebarcode }}</td>
                            <td>{{ $items->namakategori }} {{ $items->jenis }} {{ $items->merk }}</td>
                            <td
                                class="{{ strcasecmp($items->kondisi, 'rusak') === 0 ? 'text-danger' : (strcasecmp($items->kondisi, 'rusak_ringan') === 0 ? 'text-warning' : 'text-success') }}">
                                {{ $items->kondisi }}
                            </td>
                            <td>{{ $items->asal }}</td>
                            <td class="{{ $items->statusbarang == 'tersedia' ? 'text-success' : 'text-danger' }}">
                                {{ $items->statusbarang }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($items->barang_created_at)->formatLocalized('%A, %d %B %Y %H:%M') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable3').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print',
                ]
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>



</body>

</html>
