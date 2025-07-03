<?php

namespace App\Filament\Staff\Resources\ScheduleResource\Widgets;

use App\Models\Attendance;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class WeeklyAttendanceChart extends ChartWidget
{
    protected static ?string $heading = '📈 Kehadiran 7 Hari Terakhir';

    protected function getData(): array
    {
        $userId = Auth::id();
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->format('D'); // Sen, Sel, Rab...

            $hasAttendance = Attendance::where('user_id', $userId)
                ->whereDate('created_at', $date)
                ->exists();

            $data[] = $hasAttendance ? 1 : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Hadir',
                    'data' => $data,
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
