<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    
    public function definition(): array
    {
        return [
            'nama_pengguna' => $this->faker->userName,
            'hash_kata_sandi' => Hash::make('password'), // atau langsung pakai bcrypt()
            'id_peran' => 1, // atau buat random sesuai daftar peran
            'surel' => $this->faker->unique()->safeEmail,
            'nama_lengkap' => $this->faker->name,
        ];
    }
}
