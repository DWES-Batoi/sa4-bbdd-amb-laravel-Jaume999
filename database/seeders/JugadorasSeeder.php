<?php

namespace Database\Seeders;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JugadorasSeeder extends Seeder
{
    public function run(): void
    {
        $equips = Equip::all();

        foreach ($equips as $equip) {
            Jugadora::factory()->count(22)->create([
                'equip_id' => $equip->id
            ]);
        }

        dump("JugadorasSeeder: Creadas 22 jugadoras para cada uno de los " . $equips->count() . " equipos.");
    }
}

