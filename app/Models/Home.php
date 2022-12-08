<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    public function allData()
    {
        return DB::table('anggotas')
            ->leftjoin('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
            ->leftjoin('absensis', 'absensis.id_anggota', '=', 'anggotas.username')
            ->select(
                'cabangs.nama_cabang as nama',
                DB::raw('COUNT(cabangs.id) as totalanggota'),
                DB::raw('COUNT(absensis.id_anggota) as totalabsen')
            )
            ->groupBy('cabangs.nama_cabang')
            ->paginate(22);
    }
    public function totalAnggota()
    {
        return DB::table('anggotas')->count();
    }

    public function totalAbsen()
    {
        return DB::table('absensis')->count();
    }

    public function totalCabang()
    {
        return DB::table('cabangs')->count();
    }
}
