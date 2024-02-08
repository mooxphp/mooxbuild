<?php

namespace App\Filament\Resources\ActivityLogResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ActivityLogResource;

class ListActivityLogs extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ActivityLogResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
