<?php

namespace App\Filament\Resources\WpTermMetaResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\WpTermMetaResource;

class EditWpTermMeta extends EditRecord
{
    protected static string $resource = WpTermMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
