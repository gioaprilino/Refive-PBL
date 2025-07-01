<?php

namespace App\Filament\Hrd\Resources;

use App\Filament\Hrd\Resources\JobVacancyResource\Pages;
use App\Models\JobVacancy;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobVacancyResource extends Resource
{
    protected static ?string $model = JobVacancy::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Lowongan Kerja';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\FileUpload::make('thumbnail')->disk('public')->directory('job-vacancies')->image()->nullable(),
            Forms\Components\TextInput::make('author')->nullable(),
            Forms\Components\Textarea::make('description')->required()->columnSpanFull(),
            Forms\Components\DatePicker::make('deadline')->label('Deadline')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')->disk('public')->label('Thumbnail'),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('author')->label('Author'),
                Tables\Columns\TextColumn::make('created_at')->date('d M Y')->label('Tanggal'),
                Tables\Columns\TextColumn::make('deadline')->date('d M Y')->label('Deadline'),
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
            'index' => Pages\ListJobVacancies::route('/'),
            'create' => Pages\CreateJobVacancy::route('/create'),
            'edit' => Pages\EditJobVacancy::route('/{record}/edit'),
        ];
    }
}
