<?php

namespace App\Filament\Resources\RevisionResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\RevisionResource;

class ViewRevision extends ViewRecord
{
    protected static string $resource = RevisionResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
