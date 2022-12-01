<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Tri Maryanto',
            'email' => 'tri.maryanto@dianmandiri.id',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(60),
        ]);
    }
}
