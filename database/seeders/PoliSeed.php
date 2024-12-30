<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('table_poli')->insert([
            'name' => 'poli gigi',
            'keterangan' => 'gigi',
        ]);

        DB::table('table_poli')->insert([
            'name' => 'poli tht',
            'keterangan' => 'tht',
        ]);
    }
}
