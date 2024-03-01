<?php

namespace App\Filament\Resources\WpUserResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpUserResource;

class ViewWpUser extends ViewRecord
{
    protected static string $resource = WpUserResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
