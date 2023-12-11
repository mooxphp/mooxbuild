<?php

namespace App\Filament\Resources\PageResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
