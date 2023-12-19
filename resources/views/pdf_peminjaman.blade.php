<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Peminjaman</title>
    <style>
        h3, h4 {
            font-size: 13px;
            margin: 0;
        }
        h2{
            margin: 0;
        }

        p {
            font-size: 10px;
            margin: 0;
        }

        .ketua {
            position: absolute;
            right: 50px;
        }

        /* table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
        } */
    </style>
</head>
<body style="margin: 0;">

    <table border="1" cellpadding="1" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 30%; text-align: center; border: 1px solid black;">
                <img src="file://{{ public_path('storage/unib.png') }}" alt="UNIB Logo" width="100px">
            </td>

            <td style="width: 60%; text-align: center; font-size:10px; border: 1px solid black;">
                <h2>LABORATORIUM TEKNIK INFORMATIKA</h2>
                <h3>FAKULTAS TEKNIK</h3>
                <h3>UNIVERSITAS BENGKULU</h3>
                <p>JL. WR. Supratman Kel. Kandang Limun Bengkulu</p>
                <h3 style="border-top: 0.5px solid black; padding-top: 5px;">FORMULIR PEMINJAMAN BARANG/ALAT LABORATORIUM</h3>
            </td>
            <td style="width: 30%; text-align: center; border: 1px solid black;">
                <h5 style="border-bottom: 0.5px solid black; padding-bottom: 30px;">
                    Tanggal Peminjaman:
                    @if ($data_peminjaman->peminjam && $data_peminjaman->peminjam->created_at)
                        {{ \Carbon\Carbon::parse($data_peminjaman->peminjam->created_at)->format('l, d F Y') }}
                    @else
                        [Tanggal]
                    @endif
                </h5>
                <h5>No Formulir:
                    @if ($data_peminjaman->peminjam)
                        {{ $data_peminjaman->peminjam->idpeminjam }}
                    @else
                        [No Formulir]
                    @endif
                </h5>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table class="display" id="dataTable3" style="width:100%; border-collapse: collapse; border: 1px solid black;">
        <thead class="thead-dark">
            <tr style="background-color:#78D6C6; text-align: center;">
                <th style="width: 5%; border: 1px solid black;">No</th>
                <th style="border: 1px solid black;">Nama Barang</th>
                <th style="border: 1px solid black;">ID</th>
                <th style="border: 1px solid black;">Jumlah</th>
                <th style="width: 33.5%; border: 1px solid black;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center;">
                <td style="width: 5%; border: 1px solid black;">1</td>
                <td style="border: 1px solid black;">[Nama Barang]</td>
                <td style="border: 1px solid black;">[ID]</td>
                <td style="border: 1px solid black;">[Jumlah]</td>
                <td style="width: 33.5%; border: 1px solid black;">[Keterangan]</td>
            </tr>
        </tbody>
    </table>
    <h3>
        <br>
        <br>
        DATA PEMINJAM
    </h3>
    <br>
    <table class="display" id="dataTable3" style="width:100%; border-collapse: collapse; border: 1px solid black;">
        <thead class="thead-dark">
            <tr style="background-color:#78D6C6; text-align: center;">
                <th style="width: 5%; border: 1px solid black;">No</th>
                <th style="width: 25%; border: 1px solid black;">Nama</th>
                <th style="width: 26%; border: 1px solid black;">Instansi</th>
                <th style="width: 22.5%; border: 1px solid black;">Kontak</th>
                <th style="border: 1px solid black;">Durasi</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center;">
                <td style="width: 5%; border: 1px solid black;">1</td>
                <td style="border: 1px solid black;">
                    @if ($data_peminjaman->peminjam)
                        <p>{{ $data_peminjaman->peminjam->namapeminjam }}</p>
                    @else
                        <p>[Nama Peminjam]</p>
                    @endif
                </td>
                <td style="border: 1px solid black;">
                    @if ($data_peminjaman->peminjam)
                        <p>{{ $data_peminjaman->peminjam->instansi }}</p>
                    @else
                        <p>[Instansi]</p>
                    @endif
                </td>
                <td style="border: 1px solid black;">
                    @if ($data_peminjaman->peminjam)
                        <p>{{ $data_peminjaman->peminjam->kontak }}</p>
                    @else
                        <p>[Instansi]</p>
                    @endif
                </td>
                <td style="border: 1px solid black;">
                    @if ($data_peminjaman->peminjam && $data_peminjaman->peminjam->tanggalpengembalian)
                        <p>{{ \Carbon\Carbon::parse($data_peminjaman->peminjam->tanggalpengembalian)->format('l, d F Y H:i:s') }}</p>
                    @else
                        <p>[Durasi]</p>
                    @endif
                </td>
            </tr>
        </tbody>

    </table>
    <h3>
        <br>
        <br>
        SERAH TERIMA (VALIDASI PEMINJAMAN)
    </h3>
    <br>
    <table border="1" cellpadding="1" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
        <tr>
            <td style="width: 30%;  text-align: center; border: 1px solid black;">
                <h3 style="border-bottom: 0.5px solid black; padding-bottom: 5px;">PEMINJAM</h3>
                <h3><br></h3>
                <h3><br></h3>
                <h3><br></h3>
                <h3><br></h3>
                <h3 style="border-top: 0.5px solid black; padding-top: 5px;"><br></h3>
                <h3>@if ($data_peminjaman->peminjam)
                    <p>{{ $data_peminjaman->peminjam->namapeminjam }}</p>
                @else
                    <p>[Nama Peminjam]</p>
                @endif</h3>

            </td>

            <td style="width: 40%; text-align: center; border: 1px solid black;">
                <h3 style="border-bottom: 0.5px solid black; padding-bottom: 5px;">PERWAKILAN DARI PEMINJAM</h3>
                <h3><br></h3>
                <h3><br></h3>
                <h3><br></h3>
                <h3><br></h3>
                <h3 style="border-top: 0.5px solid black; padding-top: 15px;"><br></h3>
                <h3></h3>
            </td>

            <td style="width: 30%; text-align: center; border: 1px solid black;">
                <h3 style="border-bottom: 0.5px solid black; padding-bottom: 5px;">PENGURUS LABORAORIUM</h3>
                <h3><br></h3>
                <h3><br></h3>
                <h3><br></h3>
                <h3><br></h3>
                <h3 style="border-top: 0.5px solid black; padding-top: 0px;"><br></h3>
                <h3 style="font-weight: normal;">@if ($data_peminjaman->peminjam && $data_peminjaman->peminjam->user)
                    {{ $data_peminjaman->peminjam->user->name }}
                @else
                    [User ID]
                @endif</h3>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table style="width: 100%;">
        <tr>
            <td style="width: 30%;"></td>
            <td style="width: 40%;">
                <table border="1" cellpadding="1" style="width: 100%;">
                    <tr>
                        <td style="text-align: center; padding: 10px;">
                            <h3 style="border-bottom: 0.5px solid black; padding-bottom: 5px;">Ketua Laboratorium Teknik Informatika</h3>
                            <h3 style="border-top: 0.5px solid black; padding-top: 5px;"><br></h3>
                            <h3><br></h3>
                            <h3><br></h3>
                            <h3><br></h3>
                            <h3>[Nama Ketua]</h3>
                            <h3>NIP. [NIP Ketua]</h3>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 30%;"></td>
        </tr>
    </table>

</body>
</html>
