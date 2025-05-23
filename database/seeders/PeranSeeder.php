<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peranList = [
            ['kode' => 'ADM', 'nama' => 'Admin'],
            ['kode' => 'SPS', 'nama' => 'Sarana Prasarana'],
            ['kode' => 'TKNS', 'nama' => 'Teknisi'],
            ['kode' => 'DSN', 'nama' => 'Dosen'],
            ['kode' => 'TDK', 'nama' => 'Tenaga Kependidikan'],
            ['kode' => 'MHS', 'nama' => 'Mahasiswa'],
        ];

        foreach ($peranList as $item) {
            DB::table('m_peran')->insert([
                'kode_peran' => $item['kode'],
                'nama' => $item['nama'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
