<?php

namespace App\Filament\Resources\ExpiryResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ExpiryResource;

class EditExpiry extends EditRecord
{
    protected static string $resource = ExpiryResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
