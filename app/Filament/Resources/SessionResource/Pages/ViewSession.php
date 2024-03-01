<?php

namespace App\Filament\Resources\SessionResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\SessionResource;

class ViewSession extends ViewRecord
{
    protected static string $resource = SessionResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
