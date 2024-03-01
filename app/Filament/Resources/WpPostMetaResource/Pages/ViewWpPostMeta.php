<?php

namespace App\Filament\Resources\WpPostMetaResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpPostMetaResource;

class ViewWpPostMeta extends ViewRecord
{
    protected static string $resource = WpPostMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
