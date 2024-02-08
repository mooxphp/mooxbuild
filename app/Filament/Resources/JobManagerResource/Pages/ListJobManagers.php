<?php

namespace App\Filament\Resources\JobManagerResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\JobManagerResource;

class ListJobManagers extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = JobManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
