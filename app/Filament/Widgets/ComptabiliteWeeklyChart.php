<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;

class ComptabiliteWeeklyChart extends ChartWidget
{
    protected static ?string $heading = 'Revenus vs Dépenses';
    protected static string $color = 'primary';

    protected function getData(): array
    {
        $data = Transaction::selectRaw('MONTH(date) as month, categorie_id, SUM(montant) as total')
            ->join('categories', 'transactions.categorie_id', '=', 'categories.id')
            ->groupBy('month', 'categories.type')
            ->orderBy('month')
            ->get()
            ->groupBy('categorie.type');

        $revenus = $data['revenu'] ?? collect();
        $depenses = $data['dépense'] ?? collect();

        $labels = collect(range(1, 12))->map(function ($m) {
            return now()->startOfYear()->addMonths($m - 1)->format('M');
        });

        $seriesRevenus = $labels->map(function ($_, $index) use ($revenus) {
            return $revenus->firstWhere('month', $index + 1)?->total ?? 0;
        });

        $seriesDepenses = $labels->map(function ($_, $index) use ($depenses) {
            return $depenses->firstWhere('month', $index + 1)?->total ?? 0;
        });

        return [
            'datasets' => [
                [
                    'label' => 'Revenus',
                    'data' => $seriesRevenus,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)',
                ],
                [
                    'label' => 'Dépenses',
                    'data' => $seriesDepenses,
                    'borderColor' => '#EF4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // ou 'bar' si tu préfères un graphique à barres
    }
}
