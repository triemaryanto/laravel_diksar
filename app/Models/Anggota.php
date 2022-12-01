<?php

namespace App\Models;

use App\Models\Absensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Cabangs()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id');
    }
}
