<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periode = [
            '2023/2024',
            '2024/2025',
            '2025/2026',
            '2026/2027',
            '2027/2028',
            '2028/2029',
            '2029/2030',
            '2030/2031',
        ];

        foreach ($periode as $item) {
            DB::table('m_periode')->insert([
                'periode' => $item,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
