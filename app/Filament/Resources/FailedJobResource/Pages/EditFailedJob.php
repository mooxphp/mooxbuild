<?php

namespace App\Filament\Resources\FailedJobResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\FailedJobResource;

class EditFailedJob extends EditRecord
{
    protected static string $resource = FailedJobResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
