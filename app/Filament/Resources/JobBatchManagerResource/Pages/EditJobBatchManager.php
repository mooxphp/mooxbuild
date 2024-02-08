<?php

namespace App\Filament\Resources\JobBatchManagerResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\JobBatchManagerResource;

class EditJobBatchManager extends EditRecord
{
    protected static string $resource = JobBatchManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
