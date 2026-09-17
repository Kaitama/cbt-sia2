<?php

namespace App\Filament\Resources\Exams\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ExamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns()
                    ->columnSpanFull()
                    ->schema([
                        // paste di bawah sini...
                        TextInput::make('name')
                            ->label('Nama ujian')
                            ->required(),
                        TextInput::make('min_score')
                            ->label('Ambang batas nilai')
                            ->placeholder('Batas nilai gagal ujian')
                            ->required()
                            ->numeric(),
                        TextInput::make('duration')
                            ->label('Durasi ujian')
                            ->prefixIcon(Heroicon::OutlinedClock)
                            ->suffix('Menit')
                            ->required()
                            ->numeric()
                            ->default(60),
                        Toggle::make('exact_time')
                            ->label('Sesuai tanggal pelaksanaan?')
                            ->inline(false)
                            ->live()
                            ->required(),
                        DateTimePicker::make('conducted_at')
                            ->label('Tanggal pelaksanaan')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->required(),
                        DateTimePicker::make('expired_at')
                            ->label('Tanggal berakhir ujian')
                            ->native(false)
// use Filament\Schemas\Components\Utilities\Get;
                            ->hidden(
                                fn (Get $get) => $get('exact_time')
                            )
                            ->closeOnDateSelection(),
                        Textarea::make('description')
                            ->label('Keterangan tambahan')
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
