<?php

namespace App\Filament\Resources\WpTermRelationshipResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpTermRelationshipResource;

class ViewWpTermRelationship extends ViewRecord
{
    protected static string $resource = WpTermRelationshipResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
