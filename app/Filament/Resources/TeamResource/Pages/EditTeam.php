<?php

namespace App\Filament\Resources\TeamResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\TeamResource;
use Filament\Resources\Pages\EditRecord;

class EditTeam extends EditRecord
{
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
