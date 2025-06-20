<?php

namespace App\Filament\Widgets;

use App\Models\TransactionDetail;
use Filament\Widgets\DoughnutChartWidget;

class DoughnutProduk extends DoughnutChartWidget
{
    protected static ?string $heading = 'Persentase Produk Terjual';

    protected static ?int $sort = 4; // Atur urutan di dashboard

    protected function getData(): array
    {
        // 1. Ambil data produk terjual
        $data = TransactionDetail::query()
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->selectRaw('products.name as product_name, SUM(transaction_details.quantity) as total_quantity')
            ->groupBy('products.name')
            ->get();

        // 2. Format data untuk chart
        return [
            'datasets' => [
                [
                    'label' => 'Produk Terjual',
                    'data' => $data->pluck('total_quantity')->toArray(),
                    // Tambahkan warna agar menarik
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ],
                ],
            ],
            'labels' => $data->pluck('product_name')->toArray(),
        ];
    }
}