<?php

namespace App\Filament\Resources\PostalCodeResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\PostalCodeResource;

class ListPostalCodes extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = PostalCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
