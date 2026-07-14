<?php

namespace App\Filament\Resources\Categorias\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class CategoriasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagem')
                    ->label('Imagem')
                    ->disk('public')
                    ->action(
                        Action::make('visualizar_imagem')
                            ->label('Visualizar imagem')
                            ->modalHeading('Visualização da imagem')
                            ->modalContent(fn ($record) => view('filament.components.image-preview', [
                                'imageUrl' => filled($record->imagem)
                                    ? Storage::disk('public')->url($record->imagem)
                                    : null,
                                'alt' => $record->nome ?? 'Imagem da categoria',
                            ]))
                            ->modalSubmitAction(false)
                            ->modalCancelAction(false)
                            ->modalWidth('7xl'),
                    )
                    ->extraImgAttributes([
                        'class' => 'cursor-zoom-in',
                        'title' => 'Clique para ampliar',
                    ]),
                TextColumn::make('nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable(),
                IconColumn::make('ativo')
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
