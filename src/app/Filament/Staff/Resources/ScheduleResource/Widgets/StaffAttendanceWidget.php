<?php

namespace App\Filament\Staff\Resources\ScheduleResource\Widgets;

use App\Models\Attendance;
use App\Models\Schedule;
use Filament\Widgets\Widget;

class StaffAttendanceWidget extends Widget
{
    protected static string $view = 'filament.staff.resources.schedule-resource.widgets.staff-attendance-widget';

    protected static ?int $sort = -1;

    public function getTodayAttendance(): ?Attendance
    {
        return Attendance::where('user_id', auth()->id())
            ->whereDate('start_time', today())
            ->first();
    }

    public function getTodaySchedule(): ?Schedule
    {
        return Schedule::with(['office', 'shift'])
            ->where('user_id', auth()->id())
            ->first();
    }

    public function getRecentAttendances()
    {
        return Attendance::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();
    }

    public function getWeeklyChartData(): array
    {
        $dates = collect();
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $dates->push($date->format('d M'));
            $count = Attendance::where('user_id', auth()->id())
                ->whereDate('created_at', $date)
                ->exists() ? 1 : 0;
            $data[] = $count;
        }

        return [
            'labels' => $dates,
            'data' => $data,
        ];
    }

    public function getMonthlyStats(): array
    {
        $monthStart = now()->startOfMonth();
        $userId = auth()->id();

        $total = Attendance::where('user_id', $userId)
            ->whereBetween('created_at', [now()->startOfMonth(), now()])
            ->count();

        $late = Attendance::where('user_id', $userId)
            ->whereBetween('created_at', [now()->startOfMonth(), now()])
            ->whereTime('start_time', '>', '08:00:00') // Misal telat jika lebih dari jam 08.00
            ->count();

        return [
            'total' => $total,
            'late' => $late,
            'absent' => now()->day - $total, // asumsi kerja setiap hari
        ];
    }
}
