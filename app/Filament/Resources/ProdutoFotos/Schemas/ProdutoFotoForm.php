<?php

namespace App\Filament\Resources\ProdutoFotos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProdutoFotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('produto_id')
                    ->label('Produto')
                    ->relationship('produto', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
                FileUpload::make('imagem')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('produtos/galeria')
                    ->imagePreviewHeight('100')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                TextInput::make('legenda')
                    ->maxLength(255),
                TextInput::make('ordem')
                    ->numeric()
                    ->default(0),
                Toggle::make('ativo')
                    ->default(true),
            ]);
    }
}
