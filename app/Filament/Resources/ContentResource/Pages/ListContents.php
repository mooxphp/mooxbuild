<?php

namespace App\Filament\Resources\ContentResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ContentResource;

class ListContents extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ContentResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
