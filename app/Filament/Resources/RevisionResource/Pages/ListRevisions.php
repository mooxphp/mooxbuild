<?php

namespace App\Filament\Resources\RevisionResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\RevisionResource;

class ListRevisions extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = RevisionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
