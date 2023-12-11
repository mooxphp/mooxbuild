<?php

namespace App\Filament\Resources\CartResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\CartResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;

class ListCarts extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = CartResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
