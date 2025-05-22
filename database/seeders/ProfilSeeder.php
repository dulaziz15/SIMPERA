<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProfilSeeder extends Seeder
{
    public function run(): void
    {
        $namaLengkapList = [
            1 => 'Ahmad Rafiq',
            2 => 'Dewi Lestari',
            3 => 'Budi Santoso',
            4 => 'Siti Aminah',
            5 => 'Rizky Pratama',
        ];

        $users = DB::table('m_user')->get();

        foreach ($users as $user) {
            DB::table('m_profil')->insert([
                'id_pengguna' => $user->id_pengguna,
                'nama_lengkap' => $namaLengkapList[$user->id_pengguna] ?? 'Nama Pengguna Tidak Dikenal',
                'aktif' => now()->toDateString(),
                'foto_profil' => 'images/profil/default.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}