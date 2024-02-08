<?php

namespace App\Filament\Resources\JobQueueWorkerResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\JobQueueWorkerResource;

class CreateJobQueueWorker extends CreateRecord
{
    protected static string $resource = JobQueueWorkerResource::class;
}
