<?php

namespace App\Imports;

use App\Models\Pengeluaran;
use App\Models\Produksi;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class ProduksiImport implements ToModel, WithStartRow, WithHeadings, WithUpserts, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable;

    public function transformDate($value, $format = 'Y-m-d')
    {
        $newDateFormat = date($format, strtotime($value));
        return $newDateFormat;

        // try {
        //     return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        // } catch (\ErrorException $e) {
        //     return Carbon::createFromFormat($format, $value);
        // }
    }

    /**
     * Validasi row data import excel
     *
     */
    public function rules(): array
    {
        return [


            '6' => 'date|required',
            // '4' => 'string',
            '7' => function ($attr, $value, $onFailure) {
                if ($value != 'update' && $value != 'delete') {
                    $onFailure('Column aksi hanya boleh diisi dengan update atau delete !');
                }
            }
        ];
    }
    public function customValidationMessages()
    {
        return [
            //         '*.kode_pengeluaran.string' => 'Kode pengeluaran harus berupa text / string !',
            //         '*.kode_pengeluaran.unique' => 'Kode pengeluaran harus unique tidak boleh sama !',
            //         '*.nama_pengeluaran.string' => 'Nama pengeluaran harus berupa text / string !',
            //         '*.jumlah_pengeluaran.integer' => 'Jumlah pengeluaran harus berupa number / integer !',
            '*.3.date' => 'Tanggal harus berformat date contoh 2023-01-1 atau  16-01-2023 !',
            '*.3.required' => 'Tanggal harus diisi !',
            //         '*.deskripsi_pengeluaran.string' => 'Deskripsi pengeluaran harus berupa text / string !',
            //         '*.aksi.in' => 'Aksi hanya boleh diisi oleh update / delete !',
        ];
    }
    // public function customValidationAttributes()
    // {
    //     return
    //         [
    //             '3' => 'Tanggal',
    //         ];
    // }
    public function headings(): array
    {
        return ['KODE', 'NAMA', 'KG', 'MESIN', 'LOT', 'KETERANGAN', 'TANGGAL'];
    }


    public function model(array $row)
    {

        if ($row[7] == 'delete') {
            Produksi::where('kode', $row[0])
                ->where('nama', $row[1])
                ->where('kg', $row[2])
                ->where('mesin', $row[3])
                ->where('lot', $row[4])
                ->where('keterangan', $row[5])
                ->where('tanggal', $row[6])
                ->delete();
        } else {
            return new Produksi([
                'kode' => $row[0],
                'nama' => $row[1],
                'kg' => $row[2],
                'mesin' => $row[3],
                'lot' => $row[4],
                'keterangan' => $row[5],
                'tanggal' =>  $this->transformDate($row[6]),
                'aksi' => $row[7]
            ]);
        }
    }


    public function startRow(): int
    {
        return 2;
    }

    public function uniqueBy()
    {
        return "kode";
    }
}