<?php

namespace App\Filament\Staff\Resources;

use App\Filament\Staff\Resources\AssetLoanResource\Pages;
use App\Models\AssetLoan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AssetLoanResource extends Resource
{
    protected static ?string $model = AssetLoan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Pinjaman Aset';

    protected static ?string $modelLabel = 'Pinjaman Aset';

    protected static ?string $pluralModelLabel = 'Pinjaman Aset';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')->default(auth()->id()),

                Select::make('asset_id')
                    ->label('Aset')
                    ->relationship('asset', 'name')
                    ->required(),

                DatePicker::make('loan_date')
                    ->label('Tanggal Pinjam')
                    ->default(now())
                    ->required(),

                DatePicker::make('return_date')
                    ->label('Tanggal Kembali'),

                Textarea::make('remarks')
                    ->label('Catatan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('asset.name')->label('Aset'),
                TextColumn::make('loan_date')->date(),
                TextColumn::make('return_date')->date(),
                TextColumn::make('status')->badge()->color(fn (string $state) => match ($state) {
                    'pending' => 'warning',
                    'approved' => 'success',
                    'rejected' => 'danger',
                    'returned' => 'gray',
                }),
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
            'index' => Pages\ListAssetLoans::route('/'),
            'create' => Pages\CreateAssetLoan::route('/create'),
            'edit' => Pages\EditAssetLoan::route('/{record}/edit'),
        ];
    }
}
