<?php

namespace App\Filament\Resources\TimezoneResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\TimezoneResource;

class ListTimezones extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = TimezoneResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
