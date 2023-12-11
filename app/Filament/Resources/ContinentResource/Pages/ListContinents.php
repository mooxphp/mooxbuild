<?php

namespace App\Filament\Resources\ContinentResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ContinentResource;

class ListContinents extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ContinentResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
