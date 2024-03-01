<?php

namespace App\Filament\Resources\WpUserMetaResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WpUserMetaResource;

class ListWpUserMetas extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpUserMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
