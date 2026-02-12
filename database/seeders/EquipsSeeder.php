<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EquipsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear equipos manuales asociados a estadios específicos
        $estadi = Estadi::where('nom', 'Camp Nou')->first();
        if ($estadi) {
            $estadi->equips()->updateOrCreate(
                ['nom' => 'Barça Femení'],
                ['titols' => 30, 'ciutat' => 'Barcelona', 'escut' => 'barca.png']
            );
        }

        $estadi = Estadi::where('nom', 'Wanda Metropolitano')->first();
        if ($estadi) {
            $estadi->equips()->updateOrCreate(
                ['nom' => 'Atlètic de Madrid'],
                ['titols' => 10, 'ciutat' => 'Madrid', 'escut' => 'atletico.png']
            );
        }

        $estadi = Estadi::where('nom', 'Santiago Bernabéu')->first();
        if ($estadi) {
            $estadi->equips()->updateOrCreate(
                ['nom' => 'Real Madrid Femení'],
                ['titols' => 5, 'ciutat' => 'Madrid', 'escut' => 'madrid.png']
            );
        }

        // 2. Crear 10 equipos aleatorios usando la Factory (que ya tiene ciudad)
        Equip::factory()->count(10)->create();

        // 3. Crear un Manager para cada equipo existente
        foreach (Equip::all() as $equip) {
            User::updateOrCreate(
                ['email' => $equip->id . '@manager.com'],
                [
                    'name' => 'Manager ' . $equip->nom,
                    'password' => Hash::make('1234'),
                    'role' => 'manager',
                    'equip_id' => $equip->id,
                ]
            );
        }
    }
}