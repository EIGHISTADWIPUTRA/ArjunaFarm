<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalPenjualanBulanIni extends BaseWidget
{
    protected function getCards(): array
    {
        // Hitung total penjualan untuk bulan dan tahun saat ini
        $totalBulanIni = Transaction::query()
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');

        // Format angka menjadi format Rupiah
        $formattedTotal = 'Rp ' . number_format($totalBulanIni, 0, ',', '.');

        return [
            Card::make('Total Penjualan Bulan Ini', $formattedTotal)
                ->description('Pendapatan di bulan ' . now()->format('F'))
                ->descriptionIcon('heroicon-s-calendar')
                ->color('primary'),
        ];
    }
}