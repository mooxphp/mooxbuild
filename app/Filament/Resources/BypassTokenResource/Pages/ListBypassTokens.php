<?php

namespace App\Filament\Resources\BypassTokenResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\BypassTokenResource;

class ListBypassTokens extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = BypassTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
