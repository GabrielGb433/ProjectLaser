<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->optional()->sentence(3),
            'subtitulo' => fake()->optional()->sentence(6),
            'imagem' => 'banners/'.fake()->uuid().'.jpg',
            'link' => fake()->optional()->url(),
            'ativo' => true,
            'ordem' => fake()->numberBetween(0, 100),
        ];
    }
}
