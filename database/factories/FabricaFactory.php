<?php

namespace Database\Factories;

use App\Models\Fabrica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Fabrica>
 */
class FabricaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "razao_social" => fake()->company(),
            "cnpj" => fake()->numerify('##############'),
            "email" => fake()->unique()->safeEmail(),
            "telefone" => fake()->numerify("869########"),
            "ativo" => fake()
        ];
    }
}
