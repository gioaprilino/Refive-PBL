<?php

namespace App\Filament\Staff\Resources\MyProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MyTasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    protected static ?string $recordTitleAttribute = 'name';

    public function getEloquentQuery(): Builder
    {
        // AMBIL ID EMPLOYEE DARI USER YANG LOGIN
        $employeeId = Auth::user()->employee_id;

        if (! $employeeId) {
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }

        return parent::getEloquentQuery()->where('employee_id', $employeeId);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Tugas')
                    ->required()
                    ->disabled(), // dinonaktifkan
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label('Ditugaskan Kepada')
                    ->disabled(), // dinonaktifkan
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Tugas')
                    ->columnSpanFull()
                    ->disabled(), // dinonaktifkan
                Forms\Components\DatePicker::make('due_date')
                    ->label('Batas Waktu')
                    ->disabled(), // dinonaktifkan

                // HANYA FIELD INI YANG BISA DIUBAH STAFF
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'Sedang Dikerjakan',
                        'completed' => 'Selesai',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Tugas'),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Batas Waktu')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Ditugaskan Kepada')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'in_progress',
                        'success' => 'completed',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'in_progress' => 'Sedang Dikerjakan',
                        'completed' => 'Selesai',
                        default => $state,
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah Status'),
            ])
            ->bulkActions([]);
    }
}
