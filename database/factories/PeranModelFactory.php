<?php

namespace Database\Factories;

use App\Models\PeranModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PeranModel>
 */
class PeranModelFactory extends Factory
{
    protected $table = PeranModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' =>  $this->faker->word(),
            'nama' => $this->faker->word()
        ];
    }
}
