<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = fake()->words(2, true);

        return [
            'nome' => Str::title($nome),
            'slug' => Str::slug($nome).'-'.fake()->unique()->numberBetween(1000, 9999),
            'descricao' => fake()->optional()->paragraph(),
            'imagem' => null,
            'ativo' => true,
            'ordem' => fake()->numberBetween(0, 100),
        ];
    }
}
