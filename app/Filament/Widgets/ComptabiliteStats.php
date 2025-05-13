<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ComptabiliteStats extends StatsOverviewWidget
{
    protected ?string $heading = 'Résumé Comptabilité';

    protected function getStats(): array
    {
        $revenus = Transaction::whereHas('categorie', fn ($q) => $q->where('type', 'revenu'))->sum('montant');
        $depenses = Transaction::whereHas('categorie', fn ($q) => $q->where('type', 'dépense'))->sum('montant');
        $solde = $revenus - $depenses;

        return [
            Stat::make('Revenus', number_format($revenus, 2, ',', ' ') . ' €')
                ->description('Total des revenus')
                ->color('success'),

            Stat::make('Dépenses', number_format($depenses, 2, ',', ' ') . ' €')
                ->description('Total des dépenses')
                ->color('danger'),

            Stat::make('Solde net', number_format($solde, 2, ',', ' ') . ' €')
                ->description('Revenus - Dépenses')
                ->color($solde >= 0 ? 'primary' : 'danger'),
        ];
    }
}
