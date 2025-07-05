<?php

namespace App\Filament\Staff\Resources;

use App\Filament\Staff\Resources\MyProjectResource\Pages;
use App\Filament\Staff\Resources\MyProjectResource\RelationManagers\MyTasksRelationManager; // Kita akan buat ini nanti
use App\Models\EmployeeProject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MyProjectResource extends Resource
{
    protected static ?string $model = EmployeeProject::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';

    protected static ?string $navigationLabel = 'Proyek Saya';

    protected static ?string $modelLabel = 'Proyek Saya';

    protected static ?string $pluralModelLabel = 'Proyek Saya';

    /**
     * INI BAGIAN PENTING: Memfilter proyek
     * Fungsi ini memastikan bahwa hanya proyek yang di-assign ke staff yang login
     * yang akan muncul di daftar.
     */
    public static function getEloquentQuery(): Builder
    {
        // AMBIL ID EMPLOYEE DARI USER YANG LOGIN
        $employeeId = Auth::user()->employee_id;

        // Jika user tidak terhubung ke data employee, jangan tampilkan apa-apa
        if (!$employeeId) {
            return parent::getEloquentQuery()->whereRaw('1 = 0'); // Trik untuk mengembalikan hasil kosong
        }

        return parent::getEloquentQuery()
            ->where(function (Builder $query) use ($employeeId) {
                // Kondisi 1: Tampilkan proyek jika staff adalah penanggung jawabnya
                $query->where('employee_id', $employeeId)

                    // Kondisi 2: ATAU tampilkan proyek jika staff memiliki tugas di dalamnya
                    ->orWhereHas('tasks', function (Builder $taskQuery) use ($employeeId) {
                        $taskQuery->where('employee_id', $employeeId);
                    });
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Semua field di-disable (read-only) kecuali 'status'
                Forms\Components\TextInput::make('name')
                    ->label('Nama Proyek')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->disabled(), // dinonaktifkan
                Forms\Components\RichEditor::make('description')
                    ->label('Deskripsi Proyek')
                    ->required()
                    ->columnSpanFull()
                    ->disabled(), // dinonaktifkan
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label('Penanggung Jawab (Karyawan)')
                    ->disabled(), // dinonaktifkan
                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->disabled(), // dinonaktifkan
                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->disabled(), // dinonaktifkan

                // HANYA FIELD INI YANG BISA DIUBAH STAFF
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'Sedang Berjalan',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Proyek')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal Mulai')
                    ->date('d M Y'),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Tanggal Selesai')
                    ->date('d M Y'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'in_progress',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'in_progress' => 'Sedang Berjalan',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default => $state,
                    }),
            ])
            ->filters([
                // Filter bisa tetap ada jika diinginkan
            ])
            ->actions([
                // Staff hanya bisa mengedit (untuk mengubah status)
                Tables\Actions\EditAction::make()->label('Lihat & Ubah Status'),
            ])
            ->bulkActions([]); // Hapus bulk actions
    }

    public static function getRelations(): array
    {
        // Kita akan membuat Relation Manager khusus untuk staff
        return [
            MyTasksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMyProjects::route('/'),
            'edit' => Pages\EditMyProject::route('/{record}/edit'),
        ];
    }
}
