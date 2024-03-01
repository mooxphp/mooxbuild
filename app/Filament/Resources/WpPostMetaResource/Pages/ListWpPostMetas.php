<?php

namespace App\Filament\Resources\WpPostMetaResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WpPostMetaResource;

class ListWpPostMetas extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpPostMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
