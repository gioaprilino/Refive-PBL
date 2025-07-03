<?php

namespace App\Filament\Hrd\Resources;

use App\Filament\Hrd\Resources\LeaveRequestResource\Pages;
use App\Models\LeaveRequest;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LeaveRequestResource extends Resource
{
    protected static ?string $model = LeaveRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Pengajuan Cuti';

    protected static ?string $modelLabel = 'Pengajuan Cuti';

    protected static ?string $pluralModelLabel = 'Pengajuan Cuti';

    protected static ?string $navigationGroup = 'ABSENSI & CUTI';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Pegawai'),

                Forms\Components\Select::make('leave_type')
                    ->options([
                        'annual' => 'Cuti Tahunan',
                        'sick' => 'Cuti Sakit',
                        'personal' => 'Cuti Pribadi',
                        'maternity' => 'Cuti Melahirkan',
                        'paternity' => 'Cuti Ayah',
                        'emergency' => 'Cuti Darurat',
                    ])
                    ->required()
                    ->label('Jenis Cuti'),

                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->label('Tanggal Mulai'),

                Forms\Components\DatePicker::make('end_date')
                    ->required()
                    ->label('Tanggal Selesai')
                    ->after('start_date'),

                Forms\Components\TextInput::make('total_days')
                    ->numeric()
                    ->disabled()
                    ->label('Total Hari'),

                Forms\Components\Textarea::make('reason')
                    ->required()
                    ->maxLength(500)
                    ->label('Alasan'),

                Forms\Components\Textarea::make('notes')
                    ->maxLength(500)
                    ->label('Catatan'),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Menunggu Persetujuan',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ])
                    ->required()
                    ->label('Status'),

                Forms\Components\Select::make('approved_by')
                    ->relationship('approvedBy', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Disetujui Oleh')
                    ->visible(fn (string $operation): bool => $operation === 'edit'),

                Forms\Components\DateTimePicker::make('approved_at')
                    ->label('Tanggal Disetujui')
                    ->visible(fn (string $operation): bool => $operation === 'edit'),

                Forms\Components\Textarea::make('rejection_reason')
                    ->maxLength(500)
                    ->label('Alasan Penolakan')
                    ->visible(fn (string $operation): bool => $operation === 'edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
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
                    ->sortable()
                    ->label('Tanggal Mulai'),

                Tables\Columns\TextColumn::make('end_date')
                    ->date('d/m/Y')
                    ->sortable()
                    ->label('Tanggal Selesai'),

                Tables\Columns\TextColumn::make('total_days')
                    ->numeric()
                    ->sortable()
                    ->label('Total Hari'),

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

                Tables\Columns\TextColumn::make('approvedBy.name')
                    ->label('Disetujui Oleh')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Tanggal Pengajuan'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Menunggu Persetujuan',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ])
                    ->label('Status'),

                Tables\Filters\SelectFilter::make('leave_type')
                    ->options([
                        'annual' => 'Cuti Tahunan',
                        'sick' => 'Cuti Sakit',
                        'personal' => 'Cuti Pribadi',
                        'maternity' => 'Cuti Melahirkan',
                        'paternity' => 'Cuti Ayah',
                        'emergency' => 'Cuti Darurat',
                    ])
                    ->label('Jenis Cuti'),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->label('Tanggal Pengajuan'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (LeaveRequest $record): bool => $record->status === 'pending')
                    ->action(function (LeaveRequest $record) {
                        $record->update([
                            'status' => 'approved',
                            'approved_by' => Auth::id(),
                            'approved_at' => now(),
                            'rejection_reason' => null,
                        ]);

                        Notification::make()
                            ->title('Pengajuan cuti telah disetujui')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Pengajuan Cuti')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui pengajuan cuti ini?')
                    ->modalSubmitActionLabel('Ya, Setujui'),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (LeaveRequest $record): bool => $record->status === 'pending')
                    ->form([
                        Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->maxLength(500),
                    ])
                    ->action(function (LeaveRequest $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'approved_by' => Auth::id(),
                            'approved_at' => now(),
                            'rejection_reason' => $data['rejection_reason'],
                        ]);

                        Notification::make()
                            ->title('Pengajuan cuti telah ditolak')
                            ->success()
                            ->send();
                    })
                    ->modalHeading('Tolak Pengajuan Cuti')
                    ->modalDescription('Berikan alasan penolakan pengajuan cuti ini')
                    ->modalSubmitActionLabel('Tolak'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaveRequests::route('/'),
            'create' => Pages\CreateLeaveRequest::route('/create'),
            'view' => Pages\ViewLeaveRequest::route('/{record}'),
            'edit' => Pages\EditLeaveRequest::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() > 0 ? 'warning' : 'primary';
    }
}
