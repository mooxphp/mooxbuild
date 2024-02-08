<?php

namespace App\Filament\Resources\FailedJobResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\FailedJobResource;

class ListFailedJobs extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = FailedJobResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
