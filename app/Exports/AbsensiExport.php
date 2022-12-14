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
        return Absensi::join('anggotas', 'absensis.id_anggota', '=', 'anggotas.username')
            ->join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
            ->select('cabangs.nama_cabang as namacab', 'anggotas.nama as nama', 'anggotas.kelompok as kelompok', 'anggotas.po as petugas', 'absensis.created_at as createdat')
            ->get();
    }
}
