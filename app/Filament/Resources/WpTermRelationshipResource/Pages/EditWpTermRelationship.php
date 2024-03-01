<?php

namespace App\Filament\Resources\WpTermRelationshipResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\WpTermRelationshipResource;

class EditWpTermRelationship extends EditRecord
{
    protected static string $resource = WpTermRelationshipResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
