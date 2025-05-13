<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Revenus
            ['nom' => 'Digestif', 'type' => 'revenu'],
            ['nom' => 'Apéritif', 'type' => 'revenu'],
            ['nom' => 'Biere Blonde', 'type' => 'revenu'],
            ['nom' => 'Biere Pression', 'type' => 'revenu'],
            ['nom' => 'Boisson Chaude', 'type' => 'revenu'],
            ['nom' => 'Vin', 'type' => 'revenu'],
            ['nom' => 'Limonade', 'type' => 'revenu'],
            ['nom' => 'Soda', 'type' => 'revenu'],
            ['nom' => 'Jus de Fruits', 'type' => 'revenu'],
            ['nom' => 'Eau', 'type' => 'revenu'],
            ['nom' => 'Livres Occasion', 'type' => 'revenu'],
            ['nom' => 'Glace', 'type' => 'revenu'],
            ['nom' => 'Gateau', 'type' => 'revenu'],
            ['nom' => 'Snack', 'type' => 'revenu'],
            ['nom' => 'Subvention', 'type' => 'revenu'],
            ['nom' => 'Autres revenus', 'type' => 'revenu'],

            // Dépenses
            ['nom' => 'Loyer', 'type' => 'dépense'],
            ['nom' => 'Stock', 'type' => 'dépense'],
            ['nom' => 'Électricité', 'type' => 'dépense'],
            ['nom' => 'Internet', 'type' => 'dépense'],
            ['nom' => 'Salaires', 'type' => 'dépense'],
            ['nom' => 'Divers', 'type' => 'dépense'],
        ];

        foreach ($categories as $cat) {
            Categorie::firstOrCreate($cat); // évite les doublons si le seeder est relancé
        }
    }
}
