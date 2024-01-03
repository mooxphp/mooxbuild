<?php

namespace App\Filament\Resources\BlacklistResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\BlacklistResource;

class ListBlacklists extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = BlacklistResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
