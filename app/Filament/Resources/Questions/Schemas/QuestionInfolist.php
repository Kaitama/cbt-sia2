<?php

namespace App\Filament\Resources\Questions\Schemas;

use App\Models\Question;
use Dom\Text;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\TextSize;

class QuestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(4)
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('subject.name')
                            ->label('Mata pelajaran')
                            ->columnSpan(2)
                            ->placeholder('-'),
                        TextEntry::make('score')
                            ->label('Bobot nilai')
                            ->suffix(' poin')
                            ->numeric(),
                        IconEntry::make('is_active')
                            ->label('Tersedia untuk ujian')
                            ->boolean(),
                        TextEntry::make('payload')
                            ->label('Soal')
                            ->html()
                            // use Filament\Support\Enums\TextSize;
                            ->size(TextSize::Medium)
                            ->columnSpanFull(),
                        TextEntry::make('answers.option')
                            ->hiddenLabel()
                            ->listWithLineBreaks()
                            ->bulleted()
                            ->columnSpanFull(),
                        TextEntry::make('corrects')
                            ->label('Jawaban benar')
                            ->state(fn (Question $record) =>
                                $record->answers()
                                    ->where('is_correct', true)
                                    ->pluck('option')
                                    ->toArray()
                            )
                            ->badge()
                            ->color('success'),
                    ])
            ]);
    }
}
