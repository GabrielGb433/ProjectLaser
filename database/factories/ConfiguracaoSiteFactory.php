<?php

namespace Database\Factories;

use App\Models\ConfiguracaoSite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ConfiguracaoSite>
 */
class ConfiguracaoSiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_site' => fake()->company(),
            'logo' => null,
            'whatsapp' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
            'instagram' => fake()->userName(),
            'texto_quem_somos' => fake()->paragraphs(2, true),
        ];
    }
}
