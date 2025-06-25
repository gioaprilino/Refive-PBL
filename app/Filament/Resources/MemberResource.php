<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Kontent Situs';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nama')
                    ->placeholder('Masukkan nama'),
                TextInput::make('designation')
                    ->required()
                    ->label('Jabatan')
                    ->placeholder('Masukkan jabatan'),
                TextInput::make('x_url')->nullable()
                    ->label('Link X')
                    ->placeholder('Masukkan link X'),
                TextInput::make('fb_url')->nullable()
                    ->label('Link Facebook')
                    ->placeholder('Masukkan link Facebook'),
                TextInput::make('ig_url')->nullable()
                    ->label('Link Instagram')
                    ->placeholder('Masukkan link Instagram'),
                TextInput::make('in_url')->nullable()
                    ->label('Link LinkedIn')
                    ->placeholder('Masukkan link LinkedIn'),
                FileUpload::make('image')->nullable()
                    ->avatar()
                    ->label('Foto')
                    ->disk('public')
                    ->directory('members')
                    ->visibility('public')
                    ->enableOpen()
                    ->enableDownload()
                    ->acceptedFileTypes(['image/*']),
                Select::make('status')
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
                ImageColumn::make('image')
                    ->label('Foto')
                    ->size(50),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('designation')
                    ->label('Jabatan')
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
