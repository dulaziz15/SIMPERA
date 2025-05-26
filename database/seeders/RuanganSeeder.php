<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_ruangan')->insert([
            [
                'id_gedung' => 2,
                'kode' => 'R101',
                'nama' => 'Ruang Kelas A',
                'lantai' => 1,
                'deskripsi' => 'Ruang kelas untuk perkuliahan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_gedung' => 2,
                'kode' => 'R102',
                'nama' => 'Ruang Kelas B',
                'lantai' => 1,
                'deskripsi' => 'Ruang kelas untuk praktikum.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_gedung' => 2,
                'kode' => 'L201',
                'nama' => 'Lab Komputer',
                'lantai' => 2,
                'deskripsi' => 'Laboratorium komputer dengan kapasitas 40 orang.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}