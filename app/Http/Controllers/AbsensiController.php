<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Absensi;
use App\Exports\CsvExport;
use Illuminate\Http\Request;
use App\Exports\AbsensiExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

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
            $data = Absensi::join('anggotas', 'absensis.id_anggota', '=', 'anggotas.username')
                ->join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->select('cabangs.nama_cabang as namacab', 'anggotas.nama as nama', 'anggotas.kelompok as kelompok', 'anggotas.po as petugas', 'absensis.created_at as createdat', 'absensis.id as id')
                ->where($cari, 'LIKE', '%' . $request->search . '%')->paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Absensi::join('anggotas', 'absensis.id_anggota', '=', 'anggotas.username')
                ->join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
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
            $data = Absensi::join('anggotas', 'anggotas.username', '=', 'absensis.id_anggota')
                ->join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->select('cabangs.nama_cabang as namacab', 'anggotas.nama as nama', 'anggotas.kelompok as kelompok', 'anggotas.po as petugas', 'absensis.created_at as createdat', 'absensis.id as id')
                ->where($kategori, 'LIKE', '%' . $cari . '%')->get();
        } else {
            $data = Absensi::join('anggotas', 'absensis.id_anggota', '=', 'anggotas.username')
                ->join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
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
    public function datacsv()
    {
        return Excel::download(new CsvExport, 'doorprize.xlsx');
    }
    public function liatMap($id)
    {
        $dataMaps = Absensi::find($id);
        // dd($dataMaps);
        return view('/admin/maps', compact('dataMaps'));
    }
}
