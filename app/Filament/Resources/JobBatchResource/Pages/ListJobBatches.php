<?php

namespace App\Filament\Resources\JobBatchResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\JobBatchResource;

class ListJobBatches extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = JobBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
