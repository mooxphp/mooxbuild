<?php

namespace App\Filament\Resources\WpOptionResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\WpOptionResource;

class EditWpOption extends EditRecord
{
    protected static string $resource = WpOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
