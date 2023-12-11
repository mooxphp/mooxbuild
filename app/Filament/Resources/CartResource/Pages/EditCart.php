<?php

namespace App\Filament\Resources\CartResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\CartResource;
use Filament\Resources\Pages\EditRecord;

class EditCart extends EditRecord
{
    protected static string $resource = CartResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
