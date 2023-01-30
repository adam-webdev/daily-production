@extends('layouts.layout')
@section('content')
    <div class="card p-2">
        <h4 class="p-2">Selamat Datang <b>{{ $user }}</b></h4>
        <div class="row px-4 mt-3 justify-content-between align-items-center">

        </div>

    </div>

    {{-- <div class="row align-items-center">
        <div class="col-md-4 ml-4">
            <img width="400px" height="400px" src="{{ asset('asset/img/company.svg') }}" alt="">
        </div>
        <div class="col-md-6">
            <div class="row">

                <div class="col-md-4">
                    <a style="text-decoration:none; color:black; hover" href="{{ route('user.index') }}">
                        <div class="card p-4">
                            <p style="font-weight: 700">Pengguna</p>
                            <p style="font-weight: 700; font-size:38px;">{{ $pengguna }}</p>
                        </div>
                    </a>
                </div>

            </div>

        </div>
    </div> --}}
@endsection
