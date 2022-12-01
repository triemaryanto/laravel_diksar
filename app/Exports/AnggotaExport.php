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
            return Anggota::join('Cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->select('Anggotas.username', 'Anggotas.nama', 'Anggotas.tgl', 'Anggotas.kelompok', 'Anggotas.po', 'Cabangs.nama_cabang')
                ->where($kategori, 'LIKE', '%' . $cari . '%')->get();
        } else {
            return Anggota::join('Cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->select('Anggotas.username', 'Anggotas.nama', 'Anggotas.tgl', 'Anggotas.kelompok', 'Anggotas.po', 'Cabangs.nama_cabang')
                ->get();
        }
    }
}
