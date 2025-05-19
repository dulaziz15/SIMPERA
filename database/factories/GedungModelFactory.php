<?php

namespace Database\Factories;

use App\Models\GedungModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GedungModel>
 */
class GedungModelFactory extends Factory
{
    protected $model = GedungModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' => strtoupper($this->faker->lexify('???')),
            'nama' => $this->faker->word,
            'deskripsi' => $this->faker->word,
        ];
    }
}
