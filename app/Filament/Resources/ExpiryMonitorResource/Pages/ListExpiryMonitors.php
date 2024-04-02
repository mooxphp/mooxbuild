<?php

namespace App\Filament\Resources\ExpiryMonitorResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ExpiryMonitorResource;

class ListExpiryMonitors extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ExpiryMonitorResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
