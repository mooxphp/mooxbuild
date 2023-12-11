<?php

namespace App\Filament\Resources\BypassTokenResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\BypassTokenResource;

class ViewBypassToken extends ViewRecord
{
    protected static string $resource = BypassTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
