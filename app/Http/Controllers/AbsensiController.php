<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->Absensi = new Absensi();
    }

    public function dataAbsensi(Request $request)
    {
        $cari = $request->input('cari');
        if ($request->has('search')) {
            $data = Absensi::join('Anggotas', 'absensis.id_anggota', '=', 'anggotas.username')
                ->join('Cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->select('cabangs.nama_cabang as namacab', 'anggotas.nama as nama', 'anggotas.kelompok as kelompok', 'anggotas.po as petugas', 'absensis.created_at as createdat', 'absensis.id as id')
                ->where($cari, 'LIKE', '%' . $request->search . '%')->paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Absensi::join('Anggotas', 'absensis.id_anggota', '=', 'anggotas.username')
                ->join('Cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->select('cabangs.nama_cabang as namacab', 'anggotas.nama as nama', 'anggotas.kelompok as kelompok', 'anggotas.po as petugas', 'absensis.created_at as createdat', 'absensis.id as id')
                ->paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        }
        session()->flash('kategori', $cari);
        session()->flash('cari', $request->search);
        return view('/admin/absensi', compact('data'));
        // dd($data);
    }
    public function pdfabsensi()
    {
        $kategori = session()->get('kategori');
        $cari = session()->get('cari');
        if ($cari != "") {
            $data = Absensi::join('Anggotas', 'anggotas.username', '=', 'absensis.id_anggota')
                ->join('Cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->select('cabangs.nama_cabang as namacab', 'anggotas.nama as nama', 'anggotas.kelompok as kelompok', 'anggotas.po as petugas', 'absensis.created_at as createdat', 'absensis.id as id')
                ->where($kategori, 'LIKE', '%' . $cari . '%')->get();
        } else {
            $data = Absensi::join('Anggotas', 'absensis.id_anggota', '=', 'anggotas.username')
                ->join('Cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->select('cabangs.nama_cabang as namacab', 'anggotas.nama as nama', 'anggotas.kelompok as kelompok', 'anggotas.po as petugas', 'absensis.created_at as createdat', 'absensis.id as id')->get();
        }

        view()->share('data', $data);
        $pdf = PDF::loadView('admin/pdfabsensi');
        return $pdf->download('data-absensi.pdf');
        // dd($data);
    }
    public function excelAbsensi()
    {
        return Excel::download(new AbsensiExport, 'dataabsensi.xlsx');
    }
    public function liatMap($id)
    {
        $dataMaps = Absensi::find($id);
        // dd($dataMaps);
        return view('/admin/maps', compact('dataMaps'));
    }
}
