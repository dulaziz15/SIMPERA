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
        $peran = [
            'Admin',
            'Sarana Prasarana',
            'Teknisi',
            'Dosen',
            'Tenaga Kependidikan',
            'Mahasiswa',
        ];

        foreach ($peran as $item) {
            DB::table('m_peran')->insert([
                'peran' => $item,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
