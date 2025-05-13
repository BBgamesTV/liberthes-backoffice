<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Categorie;
use Filament\Forms\Components\{Select, TextInput, DatePicker, Textarea};
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';
    protected static ?string $navigationGroup = 'Comptabilité';
    protected static ?string $navigationLabel = 'Transactions';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('categorie_id')
                ->label('Catégorie')
                ->relationship('categorie', 'nom')
                ->required()
                ->reactive() // ← pour déclencher un changement dynamique
                ->afterStateUpdated(function ($state, callable $set) {
                    $categorie = Categorie::find($state);
                    if ($categorie) {
                        $set('libelle', $categorie->nom);
                        $set('type', $categorie->type);
                    }
                }),

            TextInput::make('libelle')
                ->hidden()
                ->dehydrated(),

            // TextInput::make('type')
            //     ->label('Type')
            //     ->disabled()
            //     ->dehydrated(),

            Forms\Components\TextInput::make('montant')
                ->numeric()
                ->required()
                ->label('Montant (€)'),

            Forms\Components\DatePicker::make('date')
                ->required()
                ->default(now())
                ->label('Date'),

            Forms\Components\Select::make('moyen_paiement_id')
                ->label('Moyen de paiement')
                ->relationship('moyenPaiement', 'nom')
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\Textarea::make('note')
                ->label('Note')
                ->rows(3),
        ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('libelle')
                ->label('Libellé')
                ->searchable()
                ->sortable(),

            TextColumn::make('montant')
                ->label('Montant (€)')
                ->sortable()
                ->money('EUR'),

            TextColumn::make('categorie.nom')
                ->label('Catégorie')
                ->sortable(),

            BadgeColumn::make('categorie.type')
                ->label('Type')
                ->colors([
                    'success' => 'revenu',
                    'danger' => 'dépense',
                ])
                ->icons([
                    'heroicon-o-arrow-trending-up' => 'revenu',
                    'heroicon-o-arrow-trending-down' => 'dépense',
                ])
                ->sortable(),

            TextColumn::make('moyenPaiement.nom')
                ->label('Paiement')
                ->sortable(),

            TextColumn::make('date')
                ->label('Date')
                ->date()
                ->sortable(),
        ])
        ->defaultSort('date', 'desc');
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
