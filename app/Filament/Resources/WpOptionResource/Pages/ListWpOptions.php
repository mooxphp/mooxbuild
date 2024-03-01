<?php

namespace App\Filament\Resources\WpOptionResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WpOptionResource;

class ListWpOptions extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
