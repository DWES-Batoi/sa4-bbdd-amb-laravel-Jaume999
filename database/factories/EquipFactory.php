<?php

namespace Database\Factories;

use App\Models\Equip;
use App\Models\Estadi;
// Importamos Estadi para poder asignar uno aleatorio
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipFactory extends Factory
{
    protected $model = Equip::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->company() . ' F.C.',
            'ciutat' => $this->faker->city(), // Genera una ciudad aleatoria
            'titols' => $this->faker->numberBetween(0, 50),
            'escut' => 'default_logo.png',
            // Selecciona un ID de un estadio aleatorio que ya exista
            'estadi_id' => Estadi::inRandomOrder()->first()->id ?? 1,
        ];
    }
}