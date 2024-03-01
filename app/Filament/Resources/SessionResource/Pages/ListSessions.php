<?php

namespace App\Filament\Resources\SessionResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\SessionResource;

class ListSessions extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = SessionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
