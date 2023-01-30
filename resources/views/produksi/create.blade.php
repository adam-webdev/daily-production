@extends('layouts.layout')
@section('title', 'create transaksi')
@section('content')
    <!-- Modal -->

@section('css')
    <style>
        table thead tr th {
            text-align: center;
            color: black;
            font-weight: 900;
        }

        table tbody tr td {
            padding: 0 !important;
            margin: 0 !important;
            height: auto;
        }

        .no,
        .aksi {
            color: black;
            width: 10px;
            height: 10px;
            text-align: center
        }

        table tbody tr td input,
        textarea {
            outline: none;
            border: none;
            width: 100%;
            text-align: center;
            height: 100%;
        }

        .col-5 {
            width: 5% !important;
        }

        .col-10 {
            width: 10% !important;
        }

        .col-15 {
            width: 15% !important;
        }

        .col-20 {
            width: 20% !important;
        }

        .col-25 {
            width: 25% !important;
        }
    </style>
@endsection
<div class="modal-content">
    <div class="modal-header">
        <h5 class="align-center" style="color: black;"><b> RENCANA MIXING MAKING
            </b></h5>
    </div>
    <form action="{{ route('produksi.store') }}" method="POST" class="p-4">
        @csrf
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="tanggal" style="color:black">Tanggal :</label>
                <input type="date" id="tanggal" name="tanggal"
                    class="form-control @error('tanggal') is-invalid @enderror" required>
                @error('tanggal')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KODE</th>
                    <th>NAMA</th>
                    <th>KG</th>
                    <th>MESIN</th>
                    <th>LOT</th>
                    <th>KETERANGAN</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody id="add-row">
                <tr>
                    <td class="no">1</td>
                    <td>
                        <textarea type="text" rows="2" name="kode[]"></textarea>
                    </td>
                    <td>
                        <textarea type="text" rows="2" name="nama[]"></textarea>
                    </td>
                    <td>
                        <textarea type="text" rows="2" name="kg[]"></textarea>
                    </td>
                    <td>
                        <textarea type="text" rows="2" name="mesin[]"></textarea>
                    </td>
                    <td>
                        <textarea type="text" rows="2" name="lot[]"></textarea>
                    </td>
                    <td>
                        <textarea type="text" rows="2" name="keterangan[]"></textarea>
                    </td>
                    <td class="aksi"><button type="button" class="add-row-button mt-3"
                            style="background: rgb(33, 187, 107);color:#fff;border:none;"><i
                                class="fas fa-plus"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="history.back()" data-dismiss="modal">
                Batal</button>
            <input type="submit" class="btn btn-primary btn-send" style="background: black" value="Simpan"
                id="simpan">
        </div>
    </form>
</div>



@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        var no = 1
        $('.add-row-button').on('click', function() {
            no++

            $('#add-row').append(`
            <tr class="child">
                    <td class="no">${no}</td>
                    <td >
                        <textarea type="text" rows="2" name="kode[]"></textarea>
                    </td>
                    <td >
                        <textarea type="text" rows="2" name="nama[]"></textarea>
                    </td>
                    <td >
                        <textarea type="text" rows="2" name="kg[]"></textarea>
                    </td>
                    <td ">
                        <textarea type="text" rows="2" name="mesin[]"></textarea>
                    </td>
                    <td >
                        <textarea type="text" rows="2" name="lot[]"></textarea>
                    </td>
                    <td >
                        <textarea type="text" rows="2" name="keterangan[]"></textarea>
                    </td>
                    <td class="aksi"><button type="button" class="delete-child mt-3"
                            style="background: red;color:#fff;border:none;"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>

            `)
        })

        $(document).on('click', '.delete-child', function() {
            --no
            $(this).parents('.child').remove()

        })
    })
</script>

@endsection
