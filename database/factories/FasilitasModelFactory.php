<?php

namespace Database\Factories;

use App\Models\FasilitasModel;
use App\Models\GedungModel;
use App\Models\KategoriFasilitasModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FasilitasModel>
 */
class FasilitasModelFactory extends Factory
{
    protected $model = FasilitasModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'id_kategori' => KategoriFasilitasModel::factory(),
            'lokasi' => $this->faker->word(),
            'id_gedung' => GedungModel::factory(),
            'status' => $this->faker->randomElement(['berfungsi','rusak','diperbaiki'])
        ];
    }
}
