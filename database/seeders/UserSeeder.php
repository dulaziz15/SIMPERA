<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peran = DB::table('m_peran')->pluck('id_peran', 'nama');

        $users = [
            [
                'nama_pengguna' => 'admin1',
                'kata_sandi' => 'admin123',
                'surel' => 'admin1@example.com',
                'peran' => 'Admin',
            ],
            [
                'nama_pengguna' => 'teknisi1',
                'kata_sandi' => 'teknisi123',
                'surel' => 'teknisi1@example.com',
                'peran' => 'Teknisi',
            ],
            [
                'nama_pengguna' => 'dosen1',
                'kata_sandi' => 'dosen123',
                'surel' => 'dosen1@example.com',
                'peran' => 'Dosen',
            ],

            [
                'nama_pengguna' => 'tendik1',
                'kata_sandi' => 'tendik123',
                'surel' => 'tendik1@example.com',
                'peran' => 'Tenaga Kependidikan',
            ],
            [
                'nama_pengguna' => 'mahasiswa1',
                'kata_sandi' => 'mahasiswa123',
                'surel' => 'mahasiswa@gmail.com',
                'peran' => 'Mahasiswa',
            ]
        ];

        foreach ($users as $user) {
            DB::table('m_user')->insert([
                'nama_pengguna' => $user['nama_pengguna'],
                'hash_kata_sandi' => Hash::make($user['kata_sandi']),
                'id_peran' => $peran[$user['peran']],
                'surel' => $user['surel'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}