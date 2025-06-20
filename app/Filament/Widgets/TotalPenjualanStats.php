<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalPenjualanStats extends BaseWidget
{
    protected function getCards(): array
    {
        // Hitung total seluruh penjualan
        $totalPenjualan = Transaction::sum('total_amount');
        $formattedTotal = 'Rp ' . number_format($totalPenjualan, 0, ',', '.');

        // Hitung total penjualan bulan ini
        $totalBulanIni = Transaction::query()
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');
        $formattedBulanIni = 'Rp ' . number_format($totalBulanIni, 0, ',', '.');

        // Kembalikan DUA kartu dalam satu array
        return [
            Card::make('Total Seluruh Penjualan', $formattedTotal)
                ->description('Akumulasi dari semua transaksi')
                ->color('success'),

            Card::make('Total Penjualan Bulan Ini', $formattedBulanIni)
                ->description('Pendapatan di bulan ' . now()->format('F'))
                ->color('primary'),
        ];
    }
}