<?php

namespace App\Filament\Resources\WpTermMetaResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpTermMetaResource;

class ViewWpTermMeta extends ViewRecord
{
    protected static string $resource = WpTermMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
