<?php

namespace App\Filament\Resources\JobBatchManagerResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\JobBatchManagerResource;

class ListJobBatchManagers extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = JobBatchManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
