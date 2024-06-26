<?php

namespace App\Filament\Resources\ExpiryMonitorResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ExpiryMonitorResource;

class EditExpiryMonitor extends EditRecord
{
    protected static string $resource = ExpiryMonitorResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
