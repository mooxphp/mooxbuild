<?php

namespace App\Filament\Resources\JobQueueWorkerResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\JobQueueWorkerResource;

class ListJobQueueWorkers extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = JobQueueWorkerResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
