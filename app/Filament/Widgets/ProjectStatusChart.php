<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;

class ProjectStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status Proyek';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $finished = Project::where('project_status', 'Selesai')->count();
        $onProgress = Project::where('project_status', 'On Progress')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Proyek',
                    'data' => [$finished, $onProgress],
                    'backgroundColor' => [
                        '#10b981', // Tailwind 'emerald-500' for Selesai
                        '#f59e0b', // Tailwind 'amber-500' for On Progress
                    ],
                ],
            ],
            'labels' => ['Selesai', 'On Progress'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
