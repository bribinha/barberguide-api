<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Corte Masculino', 'Corte Feminino', 'Barba', 'Manicure', 'Pedicure']),
            'duration_minutes' => fake()->randomElement([30, 45, 60]),
            'price' => fake()->randomElement([2, 20, 150])
        ];
    }
}
