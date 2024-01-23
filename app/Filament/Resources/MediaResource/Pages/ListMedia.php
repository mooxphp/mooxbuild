<?php

namespace App\Filament\Resources\MediaResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\MediaResource;
use App\Filament\Traits\HasDescendingOrder;

class ListMedia extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
