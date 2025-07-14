<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestContactMessages extends BaseWidget
{
    protected static ?string $heading = 'Pesan Kontak Terbaru';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactMessage::query()
                    ->latest('created_at')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pengirim'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subjek')
                    ->limit(30),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d M Y H:i')
                    ->label('Diterima Pada'),
            ])
            ->actions([
                Tables\Actions\Action::make('view_message')
                    ->label('Lihat Pesan')
                    ->icon('heroicon-o-eye')
                    ->modalContent(fn (ContactMessage $record) => view('filament.widgets.contact-message-modal-content', ['message' => $record]))
                    ->modalSubmitAction(false) // No submit button in modal
                    ->modalCancelActionLabel('Tutup'),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
