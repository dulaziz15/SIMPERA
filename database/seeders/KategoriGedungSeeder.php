<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KategoriGedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Administrasif',
            'Perkuliahan',
            'Umum'
        ];

        foreach ($kategori as $item) {
            DB::table('m_kategori_gedung')->insert([
                'kategori_gedung' => $item,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}