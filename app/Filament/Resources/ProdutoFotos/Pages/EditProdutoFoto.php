<?php

namespace App\Filament\Resources\ProdutoFotos\Pages;

use App\Filament\Resources\ProdutoFotos\ProdutoFotoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProdutoFoto extends EditRecord
{
    protected static string $resource = ProdutoFotoResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
