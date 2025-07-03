<?php

namespace App\Filament\Hrd\Resources;

use App\Filament\Hrd\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use App\Models\Position;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Manajemen Staff';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('profile')->nullable()
                    ->avatar()
                    ->label('Foto')
                    ->disk('public')
                    ->directory('employees')
                    ->visibility('public')
                    ->enableOpen()
                    ->enableDownload()
                    ->acceptedFileTypes(['image/*'])
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => $state ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn ($livewire) => $livewire instanceof \App\Filament\Hrd\Resources\EmployeeResource\Pages\CreateEmployee)
                    ->nullable(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->required()
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ]),
                Forms\Components\Textarea::make('address')
                    ->required(),
                Forms\Components\Select::make('department_id')
                    ->required()
                    ->reactive()
                    ->relationship('department', 'code'),
                Forms\Components\Select::make('position_id')
                    ->required()
                    ->options(function (callable $get) {
                        $departmentId = $get('department_id');
                        if (! $departmentId) {
                            return [];
                        }

                        return Position::where('department_id', $departmentId)
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->searchable()
                    ->label('Posisi'),
                Forms\Components\DatePicker::make('hire_date')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'resigned' => 'Resign',
                        'Retired' => 'Pensiun',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile')
                    ->label('Profil')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department.code')
                    ->sortable(),
                Tables\Columns\TextColumn::make('position.name')
                    ->limit(10)
                    ->sortable(),
                Tables\Columns\TextColumn::make('hire_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'resigned' => 'Resign',
                        'Retired' => 'Pensiun',
                    ])
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
