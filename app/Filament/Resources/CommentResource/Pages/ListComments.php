<?php

namespace App\Filament\Resources\CommentResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\CommentResource;

class ListComments extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
