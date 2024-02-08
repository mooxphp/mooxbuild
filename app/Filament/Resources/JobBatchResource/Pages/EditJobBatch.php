<?php

namespace App\Filament\Resources\JobBatchResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\JobBatchResource;

class EditJobBatch extends EditRecord
{
    protected static string $resource = JobBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
