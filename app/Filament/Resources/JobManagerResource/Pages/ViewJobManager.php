<?php

namespace App\Filament\Resources\JobManagerResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\JobManagerResource;

class ViewJobManager extends ViewRecord
{
    protected static string $resource = JobManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
