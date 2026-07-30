<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\FileUpload;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        // upload foto profil staff
                        FileUpload::make('photo_path')
                            ->label('Foto profil')
                            ->hiddenLabel()
                            ->image()
                            ->avatar()
                            ->alignCenter()
                            ->columnSpanFull()
                            ->disk('public')
                            ->directory('avatar')
                            ->imageEditor(),
                        TextInput::make('name')
                            ->label('Nama lengkap')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('email')
                            ->label('Alamat email')
                            ->unique('users', 'email')
                            ->email()
                            ->required(),
                        TextInput::make('password')
                            ->label('Kata sandi')
                            ->password()
                            ->revealable()
                            ->required(),
                    ])
            ]);
    }
}
