<?php

namespace App\Filament\Resources\Produtos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ProdutosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagem_principal')
                    ->label('Imagem')
                    ->disk('public')
                    ->url(fn (?string $state): ?string => filled($state) ? Storage::disk('public')->url($state) : null, true)
                    ->extraImgAttributes([
                        'class' => 'cursor-zoom-in',
                        'title' => 'Clique para ampliar',
                    ]),
                TextColumn::make('nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('categoria.nome')
                    ->label('Categoria')
                    ->sortable(),
                IconColumn::make('ativo')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('destaque')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('ordem')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('ativo'),
                TernaryFilter::make('destaque'),
                SelectFilter::make('categoria_id')
                    ->label('Categoria')
                    ->relationship('categoria', 'nome')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
