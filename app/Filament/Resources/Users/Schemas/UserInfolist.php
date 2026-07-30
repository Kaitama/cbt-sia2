<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('avatar_url')
                            ->state(fn ($record) =>
                                $record->getFilamentAvatarUrl()
                            )
                            ->hiddenLabel()
                            ->alignCenter()
                            ->columnSpanFull()
                            ->circular(),
                        TextEntry::make('name')
                            ->label('Nama pegawai'),
                        TextEntry::make('email'),
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d F Y, H:i:s')
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Diubah')
                            ->dateTime('d F Y, H:i:s')
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
