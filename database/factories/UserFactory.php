<?php

namespace Database\Factories;

use App\Models\PeranModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'nama_pengguna' => $this->faker->unique()->userName,
            'hash_kata_sandi' => bcrypt('password'),
            'id_peran' => PeranModel::factory()->create(), // Pastikan ini sesuai dengan ID yang ada di tabel m_peran
            'surel' => $this->faker->unique()->safeEmail
        ];
    }
}
