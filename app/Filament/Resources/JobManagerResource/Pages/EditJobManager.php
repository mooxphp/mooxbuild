<?php

namespace App\Filament\Resources\JobManagerResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\JobManagerResource;

class EditJobManager extends EditRecord
{
    protected static string $resource = JobManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
