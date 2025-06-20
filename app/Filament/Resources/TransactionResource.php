<?php

namespace App\Filament\Resources;

use App\Models\Transaction;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn; // Untuk menampilkan status boolean
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers\DetailsRelationManager;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Transactions';
    protected static ?string $pluralModelLabel = 'Transactions';
    protected static ?string $modelLabel = 'Transaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('is_confirmed')
                    ->label('Konfirmasi Pemesanan')
                    ->onColor('success')
                    ->offColor('danger')
                    ->helperText('Aktifkan untuk menyatakan pesanan telah dikonfirmasi.'),
            ]);
    }


public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('order_id')->label('Order ID')->sortable()->searchable(),
            TextColumn::make('name')->label('Buyer')->searchable(),
            TextColumn::make('total_amount')
                ->label('Total')
                ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 2, ',', '.'))
                ->sortable(),
            BadgeColumn::make('status')
                ->colors([
                    'primary' => 'pending',
                    'success' => 'success',
                    'info' => 'completed',
                    'danger' => ['failed', 'cancelled'],
                ])
                ->sortable(),
            IconColumn::make('is_confirmed')
                ->label('Dikonfirmasi')
                ->boolean(),
            TextColumn::make('created_at')
                ->label('Created')
                ->dateTime('d M Y, H:i')
                ->sortable(),
        ])
        ->actions([
            Action::make('konfirmasi')
                ->label('Konfirmasi')
                ->icon('heroicon-s-check-circle')
                ->color('success')
                ->visible(fn ($record) => !$record->is_confirmed)
                ->requiresConfirmation()
                ->action(function ($record) {
                    $record->is_confirmed = true;
                    $record->save();
                }),
        ])
        ->bulkActions([]);
}


    public static function getRelations(): array
    {
        return [
            DetailsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
