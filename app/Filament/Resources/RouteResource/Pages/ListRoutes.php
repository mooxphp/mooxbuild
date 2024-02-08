<?php

namespace App\Filament\Resources\RouteResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\RouteResource;
use App\Filament\Traits\HasDescendingOrder;

class ListRoutes extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = RouteResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
