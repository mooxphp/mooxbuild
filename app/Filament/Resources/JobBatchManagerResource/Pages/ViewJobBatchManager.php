<?php

namespace App\Filament\Resources\JobBatchManagerResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\JobBatchManagerResource;

class ViewJobBatchManager extends ViewRecord
{
    protected static string $resource = JobBatchManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
