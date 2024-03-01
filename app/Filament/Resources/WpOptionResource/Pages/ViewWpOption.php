<?php

namespace App\Filament\Resources\WpOptionResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpOptionResource;

class ViewWpOption extends ViewRecord
{
    protected static string $resource = WpOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
