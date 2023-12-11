<?php

namespace App\Filament\Resources\CurrencyResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\CurrencyResource;

class ListCurrencies extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = CurrencyResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
