<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\LineChartWidget;

class LaporanPenjualanMingguan extends LineChartWidget
{
    protected static ?string $heading = 'Laporan Pendapatan per Minggu';

    protected static ?int $sort = 2; // Urutan setelah widget harian

    protected function getData(): array
    {
        // Mengambil data 12 minggu terakhir
        $data = Transaction::query()
            ->where('created_at', '>=', now()->subWeeks(12))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%u") as week, SUM(total_amount) as aggregate')
            ->groupBy('week')
            ->orderBy('week', 'ASC')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan Mingguan',
                    'data' => $data->pluck('aggregate')->toArray(),
                ],
            ],
            'labels' => $data->pluck('week')->map(function ($week) {
                // Format label menjadi "Minggu 25 (16 Jun)"
                $date = Carbon::now()->setISODate(substr($week, 0, 4), substr($week, 5, 2));
                return 'Minggu ' . $date->format('W (d M)');
            })->toArray(),
        ];
    }
}