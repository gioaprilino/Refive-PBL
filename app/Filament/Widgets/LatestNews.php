<?php

namespace App\Filament\Widgets;

use App\Models\News;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestNews extends BaseWidget
{
    protected static ?string $heading = 'Berita Terbaru';

    protected static ?int $sort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                News::query()
                    ->latest('created_at')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->size(40),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->limit(40)
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->label('Penulis'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d M Y')
                    ->label('Tanggal'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn (News $record): string => \App\Filament\Resources\NewsResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
