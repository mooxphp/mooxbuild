<?php

namespace App\Filament\Resources\ExpiryMonitorResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ExpiryMonitorResource;

class ViewExpiryMonitor extends ViewRecord
{
    protected static string $resource = ExpiryMonitorResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
