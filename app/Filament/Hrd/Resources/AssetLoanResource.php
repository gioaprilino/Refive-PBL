<?php

namespace App\Filament\Hrd\Resources;

use App\Filament\Hrd\Resources\AssetLoanResource\Pages;
use App\Filament\Hrd\Resources\AssetLoanResource\RelationManagers;
use App\Models\AssetLoan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetLoanResource extends Resource
{
    protected static ?string $model = AssetLoan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Manajemen Aset';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('asset_id')
                ->relationship('asset', 'name')
                ->searchable()
                ->required(),

            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->label('Staff')
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('loan_date')
                ->label('Tanggal Pinjam')
                ->required(),

            Forms\Components\DatePicker::make('return_date')
                ->label('Tanggal Kembali'),

            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    'returned' => 'Returned',
                ])
                ->required(),

            Forms\Components\Textarea::make('remarks')
                ->label('Catatan')
                ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('asset.name')->label('Aset'),
                Tables\Columns\TextColumn::make('user.employee.name')->label('Nama Staff')->searchable(),
                Tables\Columns\TextColumn::make('loan_date')->date('d M Y'),
                Tables\Columns\TextColumn::make('return_date')->date('d M Y'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                        'gray' => 'returned',
                    ]),
                Tables\Columns\TextColumn::make('remarks')->limit(30),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(fn ($record) => $record->update(['status' => 'approved'])),

                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(fn ($record) => $record->update(['status' => 'rejected'])),

                Tables\Actions\Action::make('mark_returned')
                    ->label('Kembalikan')
                    ->color('gray')
                    ->visible(fn ($record) => $record->status === 'approved')
                    ->action(fn ($record) => $record->update([
                        'status' => 'returned',
                        'return_date' => now(),
                    ])),
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
