<?php

namespace App\Filament\Resources\SyncResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\SyncResource;

class ViewSync extends ViewRecord
{
    protected static string $resource = SyncResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
