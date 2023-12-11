<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AuthorResource;
use App\Filament\Traits\HasDescendingOrder;

class ListAuthors extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
