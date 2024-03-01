<?php

namespace App\Filament\Resources\WpTermResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpTermResource;

class ViewWpTerm extends ViewRecord
{
    protected static string $resource = WpTermResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
