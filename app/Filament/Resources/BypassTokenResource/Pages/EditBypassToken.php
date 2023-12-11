<?php

namespace App\Filament\Resources\BypassTokenResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\BypassTokenResource;

class EditBypassToken extends EditRecord
{
    protected static string $resource = BypassTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
