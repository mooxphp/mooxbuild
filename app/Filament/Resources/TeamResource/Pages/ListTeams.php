<?php

namespace App\Filament\Resources\TeamResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\TeamResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;

class ListTeams extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
