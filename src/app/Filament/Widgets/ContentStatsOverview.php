<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\News;
use App\Models\Project;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', News::count())
                ->description('Jumlah Berita yang Terbit')
                ->descriptionIcon('heroicon-o-newspaper')
                ->color('info'),
            Stat::make('Pesan Masuk', ContactMessage::count())
                ->description('Jumlah Pesan Kontak Baru')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('warning'),
            Stat::make('Total Proyek', Project::count())
                ->description('Jumlah Proyek Selesai & On Progress')
                ->descriptionIcon('heroicon-o-building-office-2')
                ->color('success'),
            Stat::make('Total Layanan', Service::count())
                ->description('Jumlah Layanan yang Ditawarkan')
                ->descriptionIcon('heroicon-o-wrench-screwdriver')
                ->color('primary'),
        ];
    }
}
