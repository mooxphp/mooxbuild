<?php

namespace App\Filament\Resources\WpUserMetaResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\WpUserMetaResource;

class EditWpUserMeta extends EditRecord
{
    protected static string $resource = WpUserMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
