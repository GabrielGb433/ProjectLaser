<?php

namespace App\Filament\Resources\ProdutoFotos;

use App\Filament\Resources\ProdutoFotos\Pages\CreateProdutoFoto;
use App\Filament\Resources\ProdutoFotos\Pages\EditProdutoFoto;
use App\Filament\Resources\ProdutoFotos\Pages\ListProdutoFotos;
use App\Filament\Resources\ProdutoFotos\Schemas\ProdutoFotoForm;
use App\Filament\Resources\ProdutoFotos\Tables\ProdutoFotosTable;
use App\Models\ProdutoFoto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProdutoFotoResource extends Resource
{
    protected static ?string $model = ProdutoFoto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'legenda';

    public static function form(Schema $schema): Schema
    {
        return ProdutoFotoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProdutoFotosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProdutoFotos::route('/'),
            'create' => CreateProdutoFoto::route('/create'),
            'edit' => EditProdutoFoto::route('/{record}/edit'),
        ];
    }
}
