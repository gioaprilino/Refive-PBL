<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Kontent Situs';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('service_id')
                        ->relationship('service', 'title')
                        ->required()
                        ->label('Category'),
                        Forms\Components\FileUpload::make('thumbnail')
                        ->image()
                        ->disk('public')
                        ->directory('project_thmbnails')
                        ->visibility('public')
                        ->enableOpen()
                        ->enableDownload()
                        ->acceptedFileTypes(['image/*']),
                        Forms\Components\FileUpload::make('images')
                        ->image()
                        ->reorderable()
                        ->disk('public')
                        ->directory('project_images')
                        ->visibility('public')
                        ->multiple()
                        ->enableOpen()
                        ->enableDownload()
                        ->acceptedFileTypes(['image/*']),
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                    Forms\Components\Select::make('project_status')
                        ->label('Status Proyek')
                        ->options([
                            'Selesai' => 'Selesai',
                            'On Progress' => 'On Progress',
                        ])
                        ->default('Selesai')
                        ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Block',
                    ])
                    ->default(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\ImageColumn::make('images')
                    ->stacked(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service.title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('project_status')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
