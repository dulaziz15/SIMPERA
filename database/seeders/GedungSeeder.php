<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil kategori dari tabel m_kategori_gedung
        $kategoriGedung = DB::table('m_kategori_gedung')->pluck('id_kategori_gedung', 'kategori_gedung');

        $gedungData = [
            [
                'kode' => 'AA',
                'nama' => 'Gedung AA',
                'deskripsi' => 'Gedung pusat administrasi.',
                'kategori' => 'Administrasif',
            ],
            [
                'kode' => 'AB',
                'nama' => 'Gedung AB',
                'deskripsi' => 'Gedung Perkuliahan Jurusan Administrasi Niaga',
                'kategori' => 'Perkuliahan',
            ],
            [
                'kode' => 'AS',
                'nama' => 'Gedung AS',
                'deskripsi' => 'Gedung Sekretariatan Bersama Organisasi Mahasiswa',
                'kategori' => 'Umum',
            ],
        ];

        foreach ($gedungData as $gedung) {
            DB::table('m_gedung')->insert([
                'id_kategori_gedung' => $kategoriGedung[$gedung['kategori']],
                'kode' => $gedung['kode'],
                'nama' => $gedung['nama'],
                'deskripsi' => $gedung['deskripsi'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}