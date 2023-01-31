<?php

namespace App\Http\Controllers;

use App\Exports\ProduksiExport;
use App\Imports\ProduksiImport;
use App\Models\Produksi;
// use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal_produksi = Produksi::all();
        return view('produksi.index', compact('jadwal_produksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'tanggal' => 'required|date'
        ], [
            'tanggal' => 'Tanggal wajib diisi!!'
        ]);

        $kode = $request->input('kode', []);
        $nama = $request->input('nama', []);
        $kg = $request->input('kg', []);
        $mesin = $request->input('mesin', []);
        $lot = $request->input('lot', []);
        $keterangan = $request->input('keterangan', []);

        $jadwal_produksi = [];

        foreach ($kode as $index => $value) {
            $jadwal_produksi[] = [
                'kode' => $kode[$index],
                'nama' => $nama[$index],
                'kg' => $kg[$index],
                'mesin' => $mesin[$index],
                'lot' => $lot[$index],
                'keterangan' => $keterangan[$index],
                'tanggal' => $request->tanggal,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('produksis')->insert($jadwal_produksi);
        Alert::success('Berhasil', 'Data berhasil ditambahkan');
        return redirect()->route('produksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produksi = Produksi::findOrFail($id);
        return view('produksi.edit', compact('produksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produksi = Produksi::findOrFail($id);
        $produksi->kode = $request->kode;
        $produksi->nama = $request->nama;
        $produksi->lot = $request->lot;
        $produksi->kg = $request->kg;
        $produksi->mesin = $request->mesin;
        $produksi->keterangan = $request->keterangan;
        $produksi->save();
        Alert::success('Berhasil', 'Data berhasil diubah.');
        return redirect()->route('produksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $produksi = Produksi::findOrFail($id);
        $produksi->delete();
        Alert::success('Berhasil', 'Data berhasil Dihapus.');
        return redirect()->route('produksi.index');
    }


    public function ViewImportData()
    {
        return view('produksi.import');
    }

    public function ImportData(Request $request)
    {
        $validated = $request->validate([
            'file_import' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new ProduksiImport, $request->file('file_import'));


        Alert::success('Berhasil', 'Data berhasil dimasukan');
        return redirect()->route('produksi.index');
    }

    public function ExportExcel()
    {
        return Excel::download(new ProduksiExport, 'jadwal-produksi.xlsx');
    }

    public function ExportCSV()
    {
        return Excel::download(new ProduksiExport, 'jadwal-produksi.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function view_produksi()
    {
        return view('produksi.laporan.laporan');
    }

    public function produksi_pdf(Request $request)
    {
        $periode = $request->periode;
        if ($periode == "all") {
            $data = Produksi::get();
            $pdf = PDF::loadView('produksi.laporan.print', compact('data', 'periode'));
            return $pdf->stream('laporan-jadwal-produksi-all.pdf');
        } else if ($periode == "periode") {
            $tgl_awal = $request->awal;
            $tgl_akhir = $request->akhir;
            $data = Produksi::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])
                ->orderBy('tanggal', 'ASC')->get();
            $pdf = PDF::loadView('produksi.laporan.print', compact('data', 'periode', 'tgl_awal', 'tgl_akhir'));
            return $pdf->stream('laporan-jadwal-produksi-perperiode.pdf');
        }
    }
}