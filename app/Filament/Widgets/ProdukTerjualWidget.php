<?php

namespace App\Filament\Widgets;

use App\Models\TransactionDetail;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class ProdukTerjualWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    // 1. Tentukan kolom default untuk diurutkan
    protected function getDefaultTableSortColumn(): ?string
    {
        return 'total_quantity';
    }

    // 2. Tentukan arah urutan default (asc atau desc)
    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    // Ubah metode ini untuk mengembalikan string
    protected function getTableFiltersLayout(): string
    {
        return 'above';
    }

    protected function getTableQuery(): Builder
    {
        return TransactionDetail::query()
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->selectRaw('products.name as product_name, SUM(transaction_details.quantity) as total_quantity')
            ->groupBy('products.name');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('product_name')
                ->label('Nama Produk')
                ->searchable(['products.name']),

            TextColumn::make('total_quantity')
                ->label('Jumlah Terjual')
                ->sortable(), // Hapus ->defaultSort() dari sini
        ];
    }

    public function getTableRecordKey(Model $record): string
    {
        return $record->product_name;
    }
}