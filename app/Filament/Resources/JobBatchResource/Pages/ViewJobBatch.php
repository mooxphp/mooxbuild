<?php

namespace App\Filament\Resources\JobBatchResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\JobBatchResource;

class ViewJobBatch extends ViewRecord
{
    protected static string $resource = JobBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
