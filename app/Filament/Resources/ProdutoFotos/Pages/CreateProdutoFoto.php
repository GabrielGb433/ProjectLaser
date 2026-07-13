<?php

namespace App\Filament\Resources\ProdutoFotos\Pages;

use App\Filament\Resources\ProdutoFotos\ProdutoFotoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProdutoFoto extends CreateRecord
{
    protected static string $resource = ProdutoFotoResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
