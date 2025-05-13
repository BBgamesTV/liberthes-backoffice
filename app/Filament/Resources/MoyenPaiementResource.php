<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MoyenPaiementResource\Pages;
use App\Filament\Resources\MoyenPaiementResource\RelationManagers;
use App\Models\MoyenPaiement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MoyenPaiementResource extends Resource
{
    protected static ?string $model = MoyenPaiement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom')
                    ->label('Nom du moyen de paiement')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMoyenPaiements::route('/'),
            'create' => Pages\CreateMoyenPaiement::route('/create'),
            'edit' => Pages\EditMoyenPaiement::route('/{record}/edit'),
        ];
    }
}
