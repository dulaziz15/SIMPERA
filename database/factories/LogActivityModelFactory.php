<?php

namespace Database\Factories;

use App\Models\LogActivityModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogActivityModel>
 */
class LogActivityModelFactory extends Factory
{
    protected $model = LogActivityModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pengguna' => 1,
            'jenis_aktivitas' => $this->faker->word,
            'deskripsi' => $this->faker->word,
            'waktu' => $this->faker->date()
        ];
    }
}
