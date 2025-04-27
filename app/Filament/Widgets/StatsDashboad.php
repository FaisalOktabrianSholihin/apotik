<?php

namespace App\Filament\Widgets;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Supplier;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsDashboad extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::count();
        $totalSupplier = Supplier::count();
        return [
            Stat::make('Jumlah Pelanggan', $totalPelanggan),
            Stat::make('Total Penjualan', $totalPenjualan),
            Stat::make('Jumlah Suppiler', $totalSupplier),
        ];
    }
}
