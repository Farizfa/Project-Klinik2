<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('table_dokter')->insert([
            'name' => 'enzo',
            'alamat' => 'batam',
            'no_hp' => '0812345',
            'id_poli' => '1',
        ]);
    }
}
