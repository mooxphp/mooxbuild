<?php

namespace App\Filament\Resources\SessionResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\SessionResource;

class EditSession extends EditRecord
{
    protected static string $resource = SessionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
