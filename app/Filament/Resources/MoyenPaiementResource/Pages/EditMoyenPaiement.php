<?php

namespace App\Filament\Resources\MoyenPaiementResource\Pages;

use App\Filament\Resources\MoyenPaiementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMoyenPaiement extends EditRecord
{
    protected static string $resource = MoyenPaiementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
