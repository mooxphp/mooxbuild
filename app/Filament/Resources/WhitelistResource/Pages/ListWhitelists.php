<?php

namespace App\Filament\Resources\WhitelistResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WhitelistResource;

class ListWhitelists extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WhitelistResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
