<?php

namespace App\Filament\Resources\ContentElementResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ContentElementResource;

class EditContentElement extends EditRecord
{
    protected static string $resource = ContentElementResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
