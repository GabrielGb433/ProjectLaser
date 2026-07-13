<?php

namespace App\Filament\Resources\ConfiguracaoSites;

use App\Filament\Resources\ConfiguracaoSites\Pages\ManageConfiguracaoSites;
use App\Models\ConfiguracaoSite;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConfiguracaoSiteResource extends Resource
{
    protected static ?string $model = ConfiguracaoSite::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nome_site';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome_site')
                    ->label('Nome do site')
                    ->maxLength(255),
                FileUpload::make('logo')
                    ->image()
                    ->disk('public')
                    ->directory('configuracoes')
                    ->imagePreviewHeight('100')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                TextInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->maxLength(255),
                TextInput::make('instagram')
                    ->maxLength(255),
                Textarea::make('texto_quem_somos')
                    ->label('Texto quem somos')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nome_site')
            ->columns([
                ImageColumn::make('logo')
                    ->disk('public'),
                TextColumn::make('nome_site')
                    ->label('Nome do site')
                    ->searchable(),
                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                TextColumn::make('instagram')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageConfiguracaoSites::route('/'),
        ];
    }
}
