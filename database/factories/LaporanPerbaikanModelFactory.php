<?php

namespace Database\Factories;

use App\Models\FasilitasModel;
use App\Models\LaporanPerbaikanModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaporanPerbaikanModel>
 */
class LaporanPerbaikanModelFactory extends Factory
{
    protected $model = LaporanPerbaikanModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pengguna'       => User::factory(), // FK relasi ke pengguna
            'id_fasilitas'      => FasilitasModel::factory(), // FK relasi ke fasilitas
            'deskripsi'         => $this->faker->sentence(),
            'url_foto'          => $this->faker->imageUrl(), // simulasikan URL foto
            'status'            => $this->faker->randomElement(['diverifikasi', 'diperbaiki', 'selesai']),
            'waktu_pelaporan'   => $this->faker->dateTimeBetween('-1 week', 'now'),
            'waktu_perubahan'   => $this->faker->dateTimeBetween('now', '+1 week')
        ];
    }
}
