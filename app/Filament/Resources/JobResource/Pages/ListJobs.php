<?php

namespace App\Filament\Resources\JobResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\JobResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;

class ListJobs extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = JobResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
