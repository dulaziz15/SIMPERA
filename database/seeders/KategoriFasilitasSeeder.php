<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KategoriFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriFasilitas = [
            ['kode' => 'FSU', 'nama' => 'Fasilitas Umum'],
            ['kode' => 'FSP', 'nama' => 'Fasilitas Penunjang'],
            ['kode' => 'FSI', 'nama' => 'Fasilitas Inti']
        ];

        foreach ($kategoriFasilitas as $item) {
            DB::table('m_kategori_fasilitas')->insert([
                'kode' => $item['kode'],
                'nama' => $item['nama'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}