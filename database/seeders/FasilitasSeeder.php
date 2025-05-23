<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_fasilitas')->insert([
            [
                'nama' => 'Proyektor Epson',
                'id_kategori' => 2,
                'id_ruangan' => 1,
                'status' => 'berfungsi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'AC Panasonic',
                'id_kategori' => 2,
                'id_ruangan' => 1,
                'status' => 'berfungsi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Meja Kayu',
                'id_kategori' => 3,
                'id_ruangan' => 2,
                'status' => 'rusak ringan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}