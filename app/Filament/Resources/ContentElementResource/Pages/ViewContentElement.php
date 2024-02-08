<?php

namespace App\Filament\Resources\ContentElementResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ContentElementResource;

class ViewContentElement extends ViewRecord
{
    protected static string $resource = ContentElementResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
