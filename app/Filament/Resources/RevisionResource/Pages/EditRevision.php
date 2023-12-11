<?php

namespace App\Filament\Resources\RevisionResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\RevisionResource;

class EditRevision extends EditRecord
{
    protected static string $resource = RevisionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
