<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KategoriFasilitasSeeder::class,
            KategoriGedungSeeder::class,
            PeriodeSeeder::class,
            PeranSeeder::class,
            UserSeeder::class,
            GedungSeeder::class,
            FasilitasSeeder::class,
            ProfilSeeder::class
        ]);
    }
}
