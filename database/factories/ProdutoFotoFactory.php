<?php

namespace Database\Factories;

use App\Models\Produto;
use App\Models\ProdutoFoto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProdutoFoto>
 */
class ProdutoFotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'produto_id' => Produto::factory(),
            'imagem' => 'produtos/galeria/'.fake()->uuid().'.jpg',
            'legenda' => fake()->optional()->sentence(3),
            'ordem' => fake()->numberBetween(0, 100),
            'ativo' => true,
        ];
    }
}
