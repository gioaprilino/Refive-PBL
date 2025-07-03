<?php

namespace App\Filament\Hrd\Widgets;

use App\Models\LeaveRequest;
use Filament\Widgets\ChartWidget;
use Flowbite\Flowbite;
use Illuminate\Support\Carbon;

class PendingLeaveRequestsChart extends ChartWidget
{
    protected static ?string $heading = 'Pengajuan Cuti Pending Bulanan';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = LeaveRequest::query()
            ->where('status', 'pending')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $data->pluck('month')->map(fn ($month) => Carbon::parse($month)->translatedFormat('F Y'))->toArray();
        $counts = $data->pluck('count')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengajuan Pending',
                    'data' => $counts,
                    'borderColor' => '#f59e0b', // Tailwind 'amber-500'
                    'backgroundColor' => '#fcd34d', // Tailwind 'amber-300'
                    'fill' => true,
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
