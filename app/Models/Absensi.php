<?php

namespace App\Models;

use App\Models\Anggota;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function anggotas()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'username');
    }
}
