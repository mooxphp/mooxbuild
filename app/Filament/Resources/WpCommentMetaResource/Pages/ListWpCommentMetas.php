<?php

namespace App\Filament\Resources\WpCommentMetaResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WpCommentMetaResource;

class ListWpCommentMetas extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpCommentMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
