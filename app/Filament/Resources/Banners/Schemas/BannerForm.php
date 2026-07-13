<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->maxLength(255),
                TextInput::make('subtitulo')
                    ->maxLength(255),
                FileUpload::make('imagem')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('banners')
                    ->imagePreviewHeight('100')
                    ->maxSize(8192)
                    ->helperText('Formatos JPG, PNG ou WebP. Tamanho máximo: 8 MB.')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                TextInput::make('link')
                    ->url()
                    ->maxLength(255),
                Toggle::make('ativo')
                    ->default(true),
                TextInput::make('ordem')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
