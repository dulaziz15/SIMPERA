<?php

namespace Database\Factories;

use App\Models\PeriodeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeriodeModelFactory extends Factory
{
    protected $model = PeriodeModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word,
            'tanggal_mulai' => $this->faker->date('Y-m-d', '2025-12-31'),
            'tanggal_selesai' => $this->faker->date('Y-m-d', '2025-12-31'),
        ];
    }
}
