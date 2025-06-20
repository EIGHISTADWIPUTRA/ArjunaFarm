<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\LineChartWidget;

class LaporanPenjualanBulanan extends LineChartWidget
{
    protected static ?string $heading = 'Laporan Pendapatan per Bulan';

    protected static ?int $sort = 3; // Urutan setelah widget mingguan

    protected function getData(): array
    {
        // Mengambil data 12 bulan terakhir
        $data = Transaction::query()
            ->where('created_at', '>=', now()->subMonths(12))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_amount) as aggregate')
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan Bulanan',
                    'data' => $data->pluck('aggregate')->toArray(),
                ],
            ],
            'labels' => $data->pluck('month')->map(function ($month) {
                // Format label menjadi "Juni 2025"
                return Carbon::createFromFormat('Y-m', $month)->format('F Y');
            })->toArray(),
        ];
    }
}