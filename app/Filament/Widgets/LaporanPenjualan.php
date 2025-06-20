<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
// use Filament\Widgets\Concerns\InteractsWithPageFilters;

class LaporanPenjualan extends ChartWidget
{
    // use InteractsWithPageFilters;

    protected static ?string $heading = 'Laporan Pendapatan Penjualan';
    protected static ?int $sort = 1;
    protected string|int|array $columnSpan = 'full';

    public ?string $filter = 'daily';

    protected function getFilters(): ?array
    {
        return [
            'daily' => 'Harian',
            'weekly' => 'Mingguan',
            'monthly' => 'Bulanan',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $query = Transaction::query();
        $labels = [];
        $data = [];

        switch ($activeFilter) {
            case 'weekly':
                $query->where('created_at', '>=', now()->subWeeks(12));
                $results = $query->selectRaw('DATE_FORMAT(created_at, "%Y-%u") as period, SUM(total_amount) as aggregate')
                    ->groupBy('period')
                    ->orderBy('period', 'ASC')
                    ->get();
                $labels = $results->pluck('period')->map(function ($week) {
                    $date = Carbon::now()->setISODate(substr($week, 0, 4), substr($week, 5, 2));
                    return 'Minggu ' . $date->format('W');
                })->toArray();
                $data = $results->pluck('aggregate')->toArray();
                break;

            case 'monthly':
                $query->where('created_at', '>=', now()->subMonths(12));
                $results = $query->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, SUM(total_amount) as aggregate')
                    ->groupBy('period')
                    ->orderBy('period', 'ASC')
                    ->get();
                $labels = $results->pluck('period')->map(fn($month) => Carbon::createFromFormat('Y-m', $month)->format('F Y'))->toArray();
                $data = $results->pluck('aggregate')->toArray();
                break;

            case 'daily':
            default:
                $query->where('created_at', '>=', now()->subDays(30));
                $results = $query->selectRaw('DATE(created_at) as period, SUM(total_amount) as aggregate')
                    ->groupBy('period')
                    ->orderBy('period', 'ASC')
                    ->get();
                $labels = $results->pluck('period')->map(fn($date) => Carbon::parse($date)->format('d M'))->toArray();
                $data = $results->pluck('aggregate')->toArray();
                break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}