<?php

namespace Database\Factories;

use App\Models\Equip;
use App\Models\Estadi;
use App\Models\Partit;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartitFactory extends Factory
{
    protected $model = Partit::class;

    public function definition(): array
    {
        $fecha = $this->faker->dateTimeBetween('-2 months', '+2 months');
        $esPasado = $fecha < new \DateTime();

        return [
            'local_id'    => Equip::factory(),
            'visitant_id' => Equip::factory(),
            'estadi_id'   => Estadi::factory(),
            
            'data'        => $fecha,
            'jornada'     => $this->faker->numberBetween(1, 34),
            
            'gols_local'    => $esPasado ? $this->faker->numberBetween(0, 5) : 0,
            'gols_visitant' => $esPasado ? $this->faker->numberBetween(0, 4) : 0,
        ];
    }
}
