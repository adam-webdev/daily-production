@extends('layouts.layout')
@section('title', 'Jadwal')
@section('content')
@section('css')
    <style>

    </style>
@endsection
@include('sweetalert::alert')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Jadwal </h1>
    <div>
        <a href="{{ route('import-data') }}" class="btn text-white" style="background: rgb(28, 191, 191)"><i
                class="fas fa-file-excel"></i>Import Excel</a>
        <a href="{{ route('export-excel') }}" class="btn text-white" style="background: rgb(37, 170, 170)"><i
                class="fas fa-table"></i>Export
            Excel</a>
        <a href="{{ route('export-csv') }}" class="btn text-white" style="background: rgb(15, 136, 136)"><i
                class="fas fa-file-csv"></i></i>Export
            CSV</a>
        <a href="{{ route('produksi.create') }}"class="btn btn-primary" style="background: black">
            + Tambah
        </a>
    </div>
</div>


<!-- Modal -->



<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr align="center" style="background: black;color:#fff;">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode </th>
                        <th>Nama</th>
                        <th>KG</th>
                        <th>Mesin</th>
                        <th>LOT </th>
                        <th>Keterangan </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal_produksi as $t)
                        <tr align="center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->tanggal }}</td>
                            <td>{{ $t->kode }}</td>
                            <td>{{ $t->nama }}</td>
                            <td>{{ $t->kg }}</td>
                            <td>{{ $t->mesin }}</td>
                            <td>{{ $t->lot }}</td>
                            <td>{{ $t->keterangan }}</td>
                            <td align="center" width="15%">

                                <a href="{{ route('produksi.edit', [$t->id]) }}" data-toggle="tooltip" title="Edit"
                                    style="background:  rgb(33, 187, 107)"
                                    class="d-none  d-sm-inline-block btn btn-sm shadow-sm">
                                    <i class="fas fa-edit fa-sm text-white-50"></i>
                                </a>
                                <a href="/produksi/hapus/{{ $t->id }}" data-toggle="tooltip" title="Hapus"
                                    onclick="return confirm('Yakin Ingin menghapus data?')" style="background: red"
                                    class="d-none d-sm-inline-block btn btn-sm  shadow-sm">
                                    <i class="fas fa-trash-alt fa-sm text-white-50"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@if (count($errors) > 0)
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show')
        })
    </script>
@endsection
@endif
