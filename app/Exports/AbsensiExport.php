<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Absensi::join('Anggotas', 'absensis.id_anggota', '=', 'anggotas.username')
            ->join('Cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
            ->select('cabangs.nama as namacab', 'anggotas.nama as nama', 'anggotas.kelompok as kelompok', 'anggotas.po as petugas', 'absensis.created_at as createdat')
            ->get();
    }
}
