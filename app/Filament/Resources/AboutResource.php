<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('heading')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description_1')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('description_2')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image_1')
                    ->image()
                    ->disk('public')
                    ->directory('about')
                    ->visibility('public')
                    ->enableOpen()
                    ->enableDownload()
                    ->acceptedFileTypes(['image/*'])
                    ->required(),
                Forms\Components\FileUpload::make('image_2')
                    ->image()
                    ->disk('public')
                    ->directory('about')
                    ->visibility('public')
                    ->enableOpen()
                    ->enableDownload()
                    ->acceptedFileTypes(['image/*'])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('heading'),
                Tables\Columns\ImageColumn::make('image_1'),
                Tables\Columns\ImageColumn::make('image_2'),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
