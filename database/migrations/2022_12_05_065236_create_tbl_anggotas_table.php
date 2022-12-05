<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anggota');
            $table->string('kelompok');
            $table->string('po');
            $table->integer('id_cabang');
            $table->integer('hadiah');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_anggotas');
    }
}
