<?php

namespace App\Filament\Resources\WpCommentMetaResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpCommentMetaResource;

class ViewWpCommentMeta extends ViewRecord
{
    protected static string $resource = WpCommentMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
