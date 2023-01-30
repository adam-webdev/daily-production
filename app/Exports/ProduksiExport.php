<?php

namespace App\Exports;

use App\Models\Produksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProduksiExport implements FromCollection, WithStyles, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
            ],
        ];
    }

    public function headings(): array
    {
        return ['KODE', 'NAMA', 'KG', 'MESIN', 'LOT', 'KETERANGAN', 'TANGGAL', 'AKSI'];
    }

    public function collection()
    {
        return Produksi::select('kode', 'nama', 'kg', 'mesin', 'lot', 'keterangan', 'tanggal', 'aksi')->get();
    }
}