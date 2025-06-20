<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalPenjualanStats extends BaseWidget
{
    protected function getCards(): array
    {
        // 1. Hitung total penjualan dari model Transaction
        $totalPenjualan = Transaction::sum('total_amount');

        // 2. Format angka menjadi format Rupiah
        $formattedTotal = 'Rp ' . number_format($totalPenjualan, 0, ',', '.');

        // 3. Kembalikan dalam bentuk Card
        return [
            Card::make('Total Seluruh Penjualan', $formattedTotal)
                ->description('Akumulasi dari semua transaksi')
                ->descriptionIcon('heroicon-s-cash')
                ->color('success'),
        ];
    }
}