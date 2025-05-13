<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class ComptabiliteWeeklyChart extends Widget
{
    protected static ?string $heading = 'Revenus & Dépenses de la semaine';
    protected int|string|array $columnSpan = 'full';

    public function render(): View
    {
        // On commence par récupérer les données
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $labels = [];
        $revenus = [];
        $depenses = [];

        foreach (range(0, 6) as $i) {
            $day = $startOfWeek->copy()->addDays($i);
            $labels[] = $day->translatedFormat('l'); // Jours de la semaine

            // Récupérer les revenus pour ce jour
            $revenus[] = Transaction::whereHas('categorie', fn ($q) => $q->where('type', 'revenu'))
                ->whereDate('date', $day)
                ->sum('montant');

            // Récupérer les dépenses pour ce jour
            $depenses[] = Transaction::whereHas('categorie', fn ($q) => $q->where('type', 'dépense'))
                ->whereDate('date', $day)
                ->sum('montant');
        }

        // Retourner la vue avec les données pour le graphique
        return view('filament.widgets.comptabilite-weekly-chart', [
            'labels' => $labels,
            'revenus' => $revenus,
            'depenses' => $depenses,
        ]);
    }
}
