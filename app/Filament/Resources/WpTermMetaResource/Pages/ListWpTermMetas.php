<?php

namespace App\Filament\Resources\WpTermMetaResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WpTermMetaResource;

class ListWpTermMetas extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpTermMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
