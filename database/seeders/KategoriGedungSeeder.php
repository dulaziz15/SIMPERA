<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriGedungModel;

class KategoriGedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_gedung' => 'Akademik'],
            ['kategori_gedung' => 'Administrasi'],
            ['kategori_gedung' => 'Laboratorium'],
            ['kategori_gedung' => 'Perpustakaan'],
            ['kategori_gedung' => 'Sarana Olahraga'],
        ];

        foreach ($data as $kategori) {
            KategoriGedungModel::create($kategori);
        }
    }
}
