<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns()
                    ->columnSpanFull()
                    ->schema([
                        Select::make('subject_id')
                            ->relationship('subject', 'name')
                            ->label('Mata pelajaran')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nama pelajaran')
                                    ->required()
                                    ->unique('subjects', 'name')
                            ])
                            ->native(false)
                            ->searchable()
                            ->preload(),

                        TextInput::make('score')
                            ->label('Bobot nilai soal')
                            ->required()
                            ->numeric()
                            ->default(1),

                        RichEditor::make('payload')
                            ->label('Deskripsi pertanyaan')
                            ->required()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('soal-img')
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Tersedia untuk ujian')
                            ->default(true)
                            ->required(),
                    ]),

// Bagian pilihan jawaban
Section::make()
    ->columns()
    ->columnSpanFull()
    ->schema([
        Repeater::make('answers')
            ->label('Pilihan jawaban')
            ->addActionLabel('Tambah pilihan baru')
            ->relationship()->columns(4)->columnSpanFull()
            ->reorderable()
            ->schema([
                TextInput::make('option')
                    ->label('Teks pilihan jawaban')
                    ->columnSpan(3)->required(),
                Toggle::make('is_correct')->label('Jawaban benar')
                    ->inline(false),
            ])
    ])

            ]); // end components
    }
}
