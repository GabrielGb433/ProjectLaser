<?php

namespace App\Filament\Resources\ConfiguracaoSites\Pages;

use App\Filament\Resources\ConfiguracaoSites\ConfiguracaoSiteResource;
use App\Models\ConfiguracaoSite;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageConfiguracaoSites extends ManageRecords
{
    protected static string $resource = ConfiguracaoSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn (): bool => ConfiguracaoSite::query()->doesntExist()),
        ];
    }
}
