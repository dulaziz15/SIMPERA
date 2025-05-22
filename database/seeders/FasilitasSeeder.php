<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = DB::table('m_kategori_fasilitas')->pluck('id_kategori', 'kode');

        $gedungList = DB::table('m_gedung')->pluck('id_gedung', 'kode');

        $fasilitas = [
            [
                'nama' => 'Proyektor Ruang 101',
                'kode_kategori' => 'FSI',
                'kode_gedung' => 'AB',
                'lokasi' => 'Ruang 101',
                'status' => 'berfungsi',
            ],
            [
                'nama' => 'AC Ruang 202',
                'kode_kategori' => 'FSP',
                'kode_gedung' => 'AB',
                'lokasi' => 'Ruang 202',
                'status' => 'berfungsi',
            ],
            [
                'nama' => 'Sofa Tamu',
                'kode_kategori' => 'FSU',
                'kode_gedung' => 'AA',
                'lokasi' => 'Ruang AA03',
                'status' => 'berfungsi',
            ],
        ];

        foreach ($fasilitas as $item) {
            DB::table('m_fasilitas')->insert([
                'nama' => $item['nama'],
                'id_kategori' => $kategoriList[$item['kode_kategori']] ?? null,
                'id_gedung' => $gedungList[$item['kode_gedung']] ?? null,
                'lokasi' => $item['lokasi'],
                'status' => $item['status'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}