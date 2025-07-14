<?php

namespace App\Filament\Hrd\Widgets;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Office;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pegawai', Employee::count())
                ->description('Jumlah seluruh pegawai')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),
            Stat::make('Pengajuan Cuti Pending', LeaveRequest::where('status', 'pending')->count())
                ->description('Jumlah pengajuan cuti menunggu')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color('warning'),
            Stat::make('Jumlah Lokasi', Office::count())
                ->description('Total lokasi terdaftar')
                ->descriptionIcon('heroicon-o-map-pin')
                ->color('info'),
        ];
    }
}
