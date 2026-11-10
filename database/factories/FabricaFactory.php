<?php

namespace Database\Factories;

use App\Models\Fabrica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Fabrica>
 */
class FabricaFactory extends Factory
{
    public function definition(): array
    {
        return [
            "razao_social" => fake()->company(),
            "cnpj" => fake()->numerify('##############'),
            "email" => fake()->unique()->safeEmail(),
            "telefone" => fake()->numerify("869########"),
            "ativo" => fake()->boolean(),
        ];
    }
}