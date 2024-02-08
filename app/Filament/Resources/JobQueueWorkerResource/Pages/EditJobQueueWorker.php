<?php

namespace App\Filament\Resources\JobQueueWorkerResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\JobQueueWorkerResource;

class EditJobQueueWorker extends EditRecord
{
    protected static string $resource = JobQueueWorkerResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
