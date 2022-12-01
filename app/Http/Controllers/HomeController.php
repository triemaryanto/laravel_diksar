<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->Home = new Home();
    }
    public function homeadmin()
    {
        $data = [
            'anggota' => $this->Home->allData(),
            'jumlahAnggota' => $this->Home->totalAnggota(),
            'jumlahAbsensi' => $this->Home->totalAbsen(),
            'jumlahCabang' => $this->Home->totalCabang(),
        ];

        // dd($data);
        return view('/admin/home', $data);
    }
}
