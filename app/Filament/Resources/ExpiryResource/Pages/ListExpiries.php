<?php

namespace App\Filament\Resources\ExpiryResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ExpiryResource;
use App\Filament\Traits\HasDescendingOrder;

class ListExpiries extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ExpiryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
