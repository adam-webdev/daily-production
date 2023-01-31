<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document Laporan</title>
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .logo {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 300px;
            margin-bottom: 30px;
        }

        .text {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        hr {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="./asset/img/mandom.png" alt="mandom logo" width="120px">
        </div>
        <div class="text">
            <h2>PT. MANDOM INDONESIA TBK</h2>
            <p>JL. Jawa, MM2100 Cibitung Industrial Estate Blok J-9, Gandamekar, Cikarang Barat, Gandamekar, Kec.
                Cikarang Bar., Kabupaten Bekasi, Jawa Barat 17520</p>
            <p>Email : mandom@co.id Fax :999999</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <h5 class="text-center" style="margin-bottom:20px">
            {{ $periode == 'all' ? 'Laporan  Jadwal produksi all ' : 'Laporan Jadwal produksi Per-periode ' . \Carbon\Carbon::parse($tgl_awal)->format('d-m-Y') . ' sampai dengan ' . \Carbon\Carbon::parse($tgl_akhir)->format('d-m-Y') }}
        </h5>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <table class="table table-striped table-bordered align-items-center" width="100%" cellspacing="0">
            <thead>
                <tr align="center">
                    <th width="2%">No</th>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Nama </th>
                    <th>Mesin</th>
                    <th>KG </th>
                    <th> LOT </th>
                    <th> Keterangan </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $r)
                    <tr>
                        <td width="2%">{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $r->kode }}</td>
                        <td>{{ $r->nama }}</td>
                        <td>{{ $r->mesin }}</td>
                        <td>{{ $r->kg }}</td>
                        <td>{{ $r->lot }}</td>
                        <td>{{ $r->keterangan }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>
{{-- @endsection --}}
