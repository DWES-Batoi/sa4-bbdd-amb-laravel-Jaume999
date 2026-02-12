<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jugadora>
 */
class JugadoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'nom' => $this->faker->name('female'),
            'data_naixement' => $this->faker->dateTimeBetween('-35 years', '-16 years')->format('Y-m-d'),
            'dorsal' => $this->faker->numberBetween(1, 99),
            'foto' => 'default.png',
        ];
    }
}
