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
        if (DB::table('users')->count() == 0) {
            DB::table('users')->insert(
                [
                    'name' => 'Tri Maryanto',
                    'email' => 'tri.maryanto@dianmandiri.id',
                    'password' => bcrypt('Ibunda93'),
                    'remember_token' => Str::random(60),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            );
        } else {
            echo "\e[31mTable is not empty, therefore NOT ";
        }
    }
}
