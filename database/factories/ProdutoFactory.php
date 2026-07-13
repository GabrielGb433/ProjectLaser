<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = fake()->words(3, true);

        return [
            'categoria_id' => Categoria::factory(),
            'nome' => Str::title($nome),
            'slug' => Str::slug($nome).'-'.fake()->unique()->numberBetween(1000, 9999),
            'descricao_curta' => fake()->optional()->sentence(),
            'descricao_completa' => fake()->optional()->paragraphs(2, true),
            'imagem_principal' => null,
            'ativo' => true,
            'destaque' => false,
            'ordem' => fake()->numberBetween(0, 100),
        ];
    }
}
