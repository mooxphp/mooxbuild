<?php

namespace App\Filament\Resources\WpTermRelationshipResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WpTermRelationshipResource;

class ListWpTermRelationships extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpTermRelationshipResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
