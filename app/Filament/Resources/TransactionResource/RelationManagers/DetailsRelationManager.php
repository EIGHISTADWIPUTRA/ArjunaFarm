<?php

namespace App\Filament\Resources\TransactionResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table; 
use Filament\Tables\Columns\TextColumn;

class DetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'details';
    protected static ?string $title = 'Detail Produk';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')->label('Product'),
                TextColumn::make('quantity')->label('Qty'),
                TextColumn::make('product.price')
                    ->label('Price')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 2, ',', '.')),
            ])
            ->headerActions([]) // tidak bisa create dari sini
            ->actions([])       // tidak bisa edit/hapus
            ->bulkActions([]);  // tidak bisa bulk delete
    }
}
