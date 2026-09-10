<?php

namespace App\Filament\Resources\Questions\Tables;

use App\Models\Question;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class QuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('No')
                    ->rowIndex()
                    ->width(40),
                TextColumn::make('subject.name')
                    ->label('Pelajaran')
                    ->searchable(),
                TextColumn::make('score')
                    ->label('Bobot')
                    ->suffix(' poin')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jawaban')
                    ->state(function (Question $record) {
                        $benar = $record->answers()
                            ->where('is_correct', true)
                            ->count();
                        $opsi = $record->answers()->count();
                        return $benar . '/' . $opsi;
                    }),
                IconColumn::make('is_active')
                    ->label('Tersedia')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // use Filament\Tables\Filters\SelectFilter;
                SelectFilter::make('subject')
                    ->relationship('subject', 'name')
                    ->label('Mata pelajaran')
                    ->multiple()
                    ->native(false),
                // use Filament\Tables\Filters\TernaryFilter;
                TernaryFilter::make('is_active')
                    ->label('Status soal')
                    ->trueLabel('Tersedia untuk diujiankan')
                    ->falseLabel('Tidak digunakan untuk ujian')
                    ->placeholder('Pilih salah satu')
                    ->native(false),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
