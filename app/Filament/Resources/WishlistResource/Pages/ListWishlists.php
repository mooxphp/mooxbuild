<?php

namespace App\Filament\Resources\WishlistResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WishlistResource;

class ListWishlists extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WishlistResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
