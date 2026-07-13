<?php

namespace App\Filament\Resources\ProdutoFotos\Pages;

use App\Filament\Resources\ProdutoFotos\ProdutoFotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProdutoFotos extends ListRecords
{
    protected static string $resource = ProdutoFotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
