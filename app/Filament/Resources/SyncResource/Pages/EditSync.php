<?php

namespace App\Filament\Resources\SyncResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\SyncResource;
use Filament\Resources\Pages\EditRecord;

class EditSync extends EditRecord
{
    protected static string $resource = SyncResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
