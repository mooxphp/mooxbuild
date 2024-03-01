<?php

namespace App\Filament\Resources\WpUserMetaResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpUserMetaResource;

class ViewWpUserMeta extends ViewRecord
{
    protected static string $resource = WpUserMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
