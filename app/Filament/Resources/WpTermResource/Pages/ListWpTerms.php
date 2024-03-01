<?php

namespace App\Filament\Resources\WpTermResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\WpTermResource;
use App\Filament\Traits\HasDescendingOrder;

class ListWpTerms extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpTermResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
