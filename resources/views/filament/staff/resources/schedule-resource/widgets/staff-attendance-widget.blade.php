<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold mb-4">📋 Kehadiran Anda</h2>

        {{-- STATUS HARI INI --}}
        <div class="mb-4">
            <h3 class="font-semibold">📅 Absensi Hari Ini</h3>
            @php $attendance = $this->getTodayAttendance(); @endphp

            @if ($attendance)
                <p>✅ Masuk: {{ $attendance->start_time ? \Carbon\Carbon::parse($attendance->start_time)->format('H:i:s') : '⚠️ Belum masuk' }}</p>
                <p>✅ Keluar: {{ $attendance->end_time ? \Carbon\Carbon::parse($attendance->end_time)->format('H:i:s') : '⚠️ Belum keluar' }}</p>
            @else
                <p>⚠️ Anda belum absen hari ini.</p>
            @endif
        </div>

        {{-- SHIFT HARI INI --}}
        <div class="mb-4">
            <h3 class="font-semibold">🕘 Jadwal Shift Hari Ini</h3>
            @php $schedule = $this->getTodaySchedule(); @endphp

            @if ($schedule)
                <p>{{ $schedule->office->name }} — {{ $schedule->shift->start_time }} → {{ $schedule->shift->end_time }}</p>
            @else
                <p>📭 Tidak ada jadwal hari ini.</p>
            @endif
        </div>

        {{-- RIWAYAT --}}
        <div class="mb-4">
            <h3 class="font-semibold">🗂️ Riwayat Absensi Terakhir</h3>
            <ul class="list-disc list-inside text-sm text-gray-700">
                @foreach ($this->getRecentAttendances() as $record)
                    <li>
                        {{ $record->created_at->format('d M Y') }} —
                        Masuk: {{ optional($record->start_time)->format('H:i:s') ?? '-' }},
                        Keluar: {{ optional($record->end_time)->format('H:i:s') ?? '-' }}
                    </li>
                @endforeach
            </ul>
        </div>
    </x-filament::card>
</x-filament::widget>
