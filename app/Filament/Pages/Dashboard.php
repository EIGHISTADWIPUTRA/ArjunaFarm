<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LaporanPenjualan;
use App\Filament\Widgets\LaporanPenjualanMingguan;
use App\Filament\Widgets\LaporanPenjualanBulanan;
use App\Filament\Widgets\TotalPenjualanStats;
use App\Filament\Widgets\ProdukTerjualWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    protected function getWidgets(): array
    {
        return [
            TotalPenjualanStats::class,
            LaporanPenjualan::class,
            LaporanPenjualanMingguan::class,
            LaporanPenjualanBulanan::class,
            ProdukTerjualWidget::class, 
        ];
    }
    
}