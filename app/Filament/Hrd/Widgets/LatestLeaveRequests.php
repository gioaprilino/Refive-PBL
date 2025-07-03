<?php

namespace App\Filament\Hrd\Widgets;

use App\Models\LeaveRequest;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestLeaveRequests extends BaseWidget
{
    protected static ?string $heading = 'Pengajuan Cuti Terbaru';

    protected static ?int $sort = 1; // Adjust sort order as needed

    public function table(Table $table): Table
    {
        return $table
            ->query(
                LeaveRequest::query()
                    ->where('status', 'pending')
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pegawai'),
                Tables\Columns\TextColumn::make('leave_type')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'annual' => 'Cuti Tahunan',
                        'sick' => 'Cuti Sakit',
                        'personal' => 'Cuti Pribadi',
                        'maternity' => 'Cuti Melahirkan',
                        'paternity' => 'Cuti Ayah',
                        'emergency' => 'Cuti Darurat',
                        default => ucfirst($state),
                    })
                    ->label('Jenis Cuti'),
                Tables\Columns\TextColumn::make('start_date')
                    ->date('d/m/Y')
                    ->label('Mulai'),
                Tables\Columns\TextColumn::make('end_date')
                    ->date('d/m/Y')
                    ->label('Selesai'),
                Tables\Columns\BadgeColumn::make('status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn (LeaveRequest $record): string => \App\Filament\Hrd\Resources\LeaveRequestResource::getUrl('view', ['record' => $record])),
                Tables\Actions\EditAction::make()
                    ->url(fn (LeaveRequest $record): string => \App\Filament\Hrd\Resources\LeaveRequestResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
