<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

class ComptabiliteGraphique extends ChartWidget
{
    protected static ?string $heading = 'Comptabilité mensuelle';
    protected static ?string $pollingInterval = null; // pas de rafraîchissement auto

    protected function getType(): string
    {
        return 'bar'; // ou 'line', 'pie', etc.
    }

    protected function getData(): array
    {
        $revenus = Transaction::selectRaw('DATE_FORMAT(date, "%Y-%m") as mois, SUM(montant) as total')
            ->where('type', 'revenu')
            ->groupBy('mois')
            ->pluck('total', 'mois');

        $depenses = Transaction::selectRaw('DATE_FORMAT(date, "%Y-%m") as mois, SUM(montant) as total')
            ->where('type', 'dépense')
            ->groupBy('mois')
            ->pluck('total', 'mois');

        $mois = collect(array_merge($revenus->keys()->toArray(), $depenses->keys()->toArray()))
            ->unique()
            ->sort()
            ->values();

        return [
            'datasets' => [
                [
                    'label' => 'Revenus',
                    'data' => $mois->map(fn ($m) => $revenus[$m] ?? 0)->toArray(),
                    'backgroundColor' => 'rgba(54, 235, 78, 0.6)',
                ],
                [
                    'label' => 'Dépenses',
                    'data' => $mois->map(fn ($m) => $depenses[$m] ?? 0)->toArray(),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.6)',
                ],
            ],
            'labels' => $mois->toArray(),
        ];
    }
}


