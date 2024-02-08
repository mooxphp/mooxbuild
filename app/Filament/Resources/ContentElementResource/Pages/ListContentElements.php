<?php

namespace App\Filament\Resources\ContentElementResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ContentElementResource;

class ListContentElements extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ContentElementResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
