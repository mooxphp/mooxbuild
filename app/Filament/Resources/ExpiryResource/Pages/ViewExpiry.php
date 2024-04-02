<?php

namespace App\Filament\Resources\ExpiryResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ExpiryResource;

class ViewExpiry extends ViewRecord
{
    protected static string $resource = ExpiryResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
