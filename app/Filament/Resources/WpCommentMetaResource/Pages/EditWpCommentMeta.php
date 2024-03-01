<?php

namespace App\Filament\Resources\WpCommentMetaResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\WpCommentMetaResource;

class EditWpCommentMeta extends EditRecord
{
    protected static string $resource = WpCommentMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
