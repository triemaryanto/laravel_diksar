<?php

namespace App\Exports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnggotaExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $kategori = session()->get('kategori');
        $cari = session()->get('cari');
        if ($cari != "") {
            return Anggota::join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->select('anggotas.username', 'anggotas.nama', 'anggotas.tgl', 'anggotas.kelompok', 'anggotas.po', 'cabangs.nama_cabang')
                ->where($kategori, 'LIKE', '%' . $cari . '%')->get();
        } else {
            return Anggota::join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->select('anggotas.username', 'Anggotas.nama', 'anggotas.tgl', 'anggotas.kelompok', 'anggotas.po', 'cabangs.nama_cabang')
                ->get();
        }
    }
}
