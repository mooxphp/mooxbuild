<?php

namespace App\Filament\Resources\WpTermResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\WpTermResource;

class EditWpTerm extends EditRecord
{
    protected static string $resource = WpTermResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
