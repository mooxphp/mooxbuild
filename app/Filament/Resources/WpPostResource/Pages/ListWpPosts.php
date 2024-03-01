<?php

namespace App\Filament\Resources\WpPostResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\WpPostResource;
use App\Filament\Traits\HasDescendingOrder;

class ListWpPosts extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpPostResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
