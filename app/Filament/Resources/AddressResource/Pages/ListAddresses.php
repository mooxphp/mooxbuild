<?php

namespace App\Filament\Resources\AddressResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\AddressResource;

class ListAddresses extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = AddressResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
