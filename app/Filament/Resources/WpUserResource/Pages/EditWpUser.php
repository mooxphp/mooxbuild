<?php

namespace App\Filament\Resources\WpUserResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\WpUserResource;

class EditWpUser extends EditRecord
{
    protected static string $resource = WpUserResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
