<?php

namespace App\Filament\Resources\WpCommentResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WpCommentResource;

class ListWpComments extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
