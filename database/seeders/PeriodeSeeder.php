<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            [$startYear, $endYear] = explode('/', $item);

            DB::table('periode')->insert([
                'nama' => $item,
                'tanggal_mulai' => Carbon::create($startYear, 7, 1), // mulai 1 Juli
                'tanggal_selesai' => Carbon::create($endYear, 6, 30), // selesai 30 Juni
            ]);
        }
    }
}