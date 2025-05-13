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

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';
    protected static ?string $navigationGroup = 'Comptabilité';
    protected static ?string $navigationLabel = 'Transactions';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')
                ->options([
                    'revenu' => 'Revenu',
                    'dépense' => 'Dépense',
                ])
                ->required()
                ->label('Type'),

            Forms\Components\Select::make('categorie_id')
                ->label('Catégorie')
                ->relationship('categorie', 'nom')
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\TextInput::make('montant')
                ->numeric()
                ->required()
                ->label('Montant (€)'),

            Forms\Components\DatePicker::make('date')
                ->required()
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
        return $table->columns([
            Tables\Columns\TextColumn::make('date')
                ->sortable()
                ->label('Date'),

            Tables\Columns\BadgeColumn::make('type')
                ->colors([
                    'success' => 'revenu',
                    'danger' => 'dépense',
                ])
                ->label('Type'),

            Tables\Columns\TextColumn::make('categorie.nom')
                ->label('Catégorie')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('montant')
                ->money('EUR')
                ->label('Montant'),

            Tables\Columns\TextColumn::make('moyenPaiement.nom')
                ->label('Paiement')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('note')
                ->limit(30)
                ->label('Note'),
        ])->filters([
            Tables\Filters\SelectFilter::make('type')
                ->options([
                    'revenu' => 'Revenu',
                    'dépense' => 'Dépense',
                ])
                ->label('Type'),
        ])->defaultSort('date', 'desc');
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
