<?php

namespace App\Filament\Resources\JobQueueWorkerResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\JobQueueWorkerResource;

class ViewJobQueueWorker extends ViewRecord
{
    protected static string $resource = JobQueueWorkerResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
