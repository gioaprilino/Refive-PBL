<?php

namespace App\Filament\Hrd\Resources;

use App\Filament\Hrd\Resources\AttendanceResource\Pages;
use App\Models\Attendance;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Rekap Absensi';

    protected static ?string $modelLabel = 'Rekap Absensi';

    protected static ?string $pluralModelLabel = 'Rekap Absensi';

    protected static ?string $navigationGroup = 'ABSENSI & CUTI';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Nama Pegawai'),
                TextColumn::make('start_time')->label('Jam Masuk'),
                TextColumn::make('end_time')->label('Jam Pulang'),
                TextColumn::make('created_at')->dateTime('d M Y')->label('Tanggal'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListAttendances::route('/'),
        ];
    }
}
