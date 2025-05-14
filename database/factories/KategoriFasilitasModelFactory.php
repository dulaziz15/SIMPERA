<?php

namespace Database\Factories;

use App\Models\KategoriFasilitasModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KategoriFasilitasModel>
 */
class KategoriFasilitasModelFactory extends Factory
{
    protected $model = KategoriFasilitasModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' => $this->faker->word,
            'nama' => $this->faker->word,
        ];
    }
}
