<?php

namespace App\Filament\Resources\WpCommentResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpCommentResource;

class ViewWpComment extends ViewRecord
{
    protected static string $resource = WpCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
