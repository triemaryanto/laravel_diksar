<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnggotaExport;
use App\Models\tbl_anggota;

class AnggotaController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function loginproses(Request $request)
    {


        // dd($request->all());
        $this->validate(
            $request,
            ['username' => 'required'],
            ['tgl' => 'required'],
            ['latitude' => 'required'],
            ['longitude' => 'required'],

        );

        $username = $request->input('username');
        $tgl = $request->input('tgl');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        if ($latitude == "") {
            return redirect('/login')->with('failed', 'Id Anggota atau Tanggal Lahir Salah Dan Pastikan lokasi sudah diijinkan!');
        } else {

            $ip = $request->input('ip');
            $data = Anggota::where('username', $username)->first();
            $users = DB::table('anggotas')->where(['username' => $username])->where(['tgl' => $tgl])->get();
            $absensis = DB::table('absensis')->where(['id_anggota' => $username])->get();
            foreach ($users as $row) {
            }
            if (count($users) > 0) {
                if (count($absensis) > 0) {
                    session(['berhasil_login' => true]);
                    Session::put('nama', $row->nama);
                    Session::put('username', $row->username);
                    return redirect('/home');
                } else {
                    session(['berhasil_login' => true]);
                    Session::put('nama', $row->nama);
                    Session::put('username', $row->username);
                    DB::table('absensis')->insert([
                        'id_anggota' => $row->username,
                        'status' => 'hadir',
                        'id_cabang' => $row->id_cabang,
                        'created_at' => date('Y-m-d H:i:s'),
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'ip' => $ip,
                    ]);
                    tbl_anggota::insert([
                        'nama_anggota' => $data->nama,
                        'kelompok' => $data->kelompok,
                        'po' => $data->po,
                        'id_cabang' => $data->id_cabang,
                        'hadiah' => '0',
                        'status' => '0',
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    return redirect('/home');
                }
            } else {
                return redirect('/login')->with('failed', 'Id Anggota atau Tanggal Lahir Salah Dan Pastikan GPS sudah Aktif!');
            }
        }
        // dd($data->id_cabang);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
    public function home()
    {
        return view('/anggota/home');
    }
    public function dataAnggota(Request $request)
    {
        $cari = $request->input('cari');
        if ($request->has('search')) {
            $data = Anggota::join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->where($cari, 'LIKE', '%' . $request->search . '%')->paginate(10)->withQueryString();
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Anggota::join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->paginate(10);
            Session::put('halaman_url', request()->fullUrl());
        }
        session()->flash('kategori', $cari);
        session()->flash('cari', $request->search);
        return view('/admin/anggota', compact('data'));
    }
    public function pdfanggota()
    {
        $kategori = session()->get('kategori');
        $cari = session()->get('cari');
        if ($cari != "") {
            $data = Anggota::join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->where($kategori, 'LIKE', '%' . $cari . '%')->get();
        } else {
            $data = Anggota::join('cabangs', 'cabangs.id', '=', 'anggotas.id_cabang')
                ->get();
        }
        view()->share('data', $data);
        $pdf = PDF::loadView('admin/pdfanggota');
        return $pdf->download('data-anggota.pdf');
        // dd($data);
    }
    public function excelAnggota()
    {
        return Excel::download(new AnggotaExport, 'dataanggota.xlsx');
    }
}
