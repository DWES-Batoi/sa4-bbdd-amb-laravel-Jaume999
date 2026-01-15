<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Partit;
use Illuminate\Database\Seeder;

class PartitsSeeder extends Seeder
{
    public function run(): void
    {
        $equips = Equip::all();

        foreach ($equips as $local) {
            foreach ($equips as $visitant) {
                if ($local->id !== $visitant->id) {
                    
                    Partit::factory()->create([
                        'local_id'    => $local->id,
                        'visitant_id' => $visitant->id,
                        'estadi_id'   => $local->estadi_id,
                    ]);
                    
                }
            }
        }

        dump("PartitsSeeder: Calendario generado usando PartitFactory.");
    }
}
