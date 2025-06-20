<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class LaporanPenjualan extends LineChartWidget
{
    protected static ?string $heading = 'Laporan Pendapatan Penjualan per Hari';

    protected static ?int $sort = 1; // Atur urutan widget jika perlu

    protected function getData(): array
    {
        // Ambil data transaksi, kelompokkan per hari, dan jumlahkan total_amount
        // Contoh ini mengambil data 30 hari terakhir
        $data = Transaction::query()
            // ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as aggregate')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
            // dd($data); 

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $data->pluck('aggregate')->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgb(54, 162, 235)',
                ],
            ],
            'labels' => $data->pluck('date')->map(function ($date) {
                return Carbon::parse($date)->format('d M');
            })->toArray(),
        ];
    }
}