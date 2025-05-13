<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MoyenPaiement;

class MoyenPaiementSeeder extends Seeder
{
    public function run(): void
    {
        $moyens = [
            ['nom' => 'Espèces'],
            ['nom' => 'CB'],
            ['nom' => 'Lydia'],
            ['nom' => 'Virement'],
            ['nom' => 'Chèque'],
            ['nom' => 'Autre'],
        ];

        foreach ($moyens as $moyen) {
            MoyenPaiement::firstOrCreate($moyen);
        }
    }
}
