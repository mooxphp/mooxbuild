<?php

namespace App\Filament\Resources\SeoResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\SeoResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;

class ListSeos extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = SeoResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
