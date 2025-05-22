<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GedungModel;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode' => 'GD001',
                'nama' => 'Gedung Rektorat',
                'deskripsi' => 'Pusat administrasi dan manajemen universitas.',
                'id_kategori_gedung' => 2, // Administrasi
            ],
            [
                'kode' => 'GD002',
                'nama' => 'Gedung Fakultas Teknik',
                'deskripsi' => 'Gedung akademik untuk kegiatan perkuliahan teknik.',
                'id_kategori_gedung' => 1, // Akademik
            ],
            [
                'kode' => 'GD003',
                'nama' => 'Gedung Lab Komputer',
                'deskripsi' => 'Laboratorium komputer untuk praktikum mahasiswa.',
                'id_kategori_gedung' => 3, // Laboratorium
            ],
            [
                'kode' => 'GD004',
                'nama' => 'Gedung Perpustakaan',
                'deskripsi' => 'Tempat penyimpanan dan peminjaman buku.',
                'id_kategori_gedung' => 4, // Perpustakaan
            ],
        ];

        foreach ($data as $gedung) {
            GedungModel::create($gedung);
        }
    }
}
