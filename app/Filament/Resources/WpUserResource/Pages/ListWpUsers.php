<?php

namespace App\Filament\Resources\WpUserResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\WpUserResource;
use App\Filament\Traits\HasDescendingOrder;

class ListWpUsers extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpUserResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
