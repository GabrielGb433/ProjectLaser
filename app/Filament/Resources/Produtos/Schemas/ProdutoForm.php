<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProdutoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('categoria_id')
                    ->label('Categoria')
                    ->relationship('categoria', 'nome')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nome')
                    ->required()
                    ->live(onBlur: true)
                    ->maxLength(255)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('descricao_curta')
                    ->label('Descricao curta')
                    ->maxLength(255),
                Textarea::make('descricao_completa')
                    ->label('Descricao completa')
                    ->columnSpanFull(),
                FileUpload::make('imagem_principal')
                    ->label('Imagem principal')
                    ->image()
                    ->disk('public')
                    ->directory('produtos')
                    ->imagePreviewHeight('100')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                Toggle::make('ativo')
                    ->default(true),
                Toggle::make('destaque')
                    ->default(false),
                TextInput::make('ordem')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
