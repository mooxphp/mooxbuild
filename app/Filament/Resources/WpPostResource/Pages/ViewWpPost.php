<?php

namespace App\Filament\Resources\WpPostResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpPostResource;

class ViewWpPost extends ViewRecord
{
    protected static string $resource = WpPostResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
