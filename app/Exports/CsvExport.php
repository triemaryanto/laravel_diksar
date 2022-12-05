<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;

class CsvExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Absensi::join('anggotas', 'absensis.id_anggota', '=', 'anggotas.username')
            ->join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
            ->select('absensis.id_anggota', 'anggotas.nama', 'cabangs.nama_cabang', 'anggotas.kategori')
            ->get();
    }
}
