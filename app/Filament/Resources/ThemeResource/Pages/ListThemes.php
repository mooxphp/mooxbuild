<?php

namespace App\Filament\Resources\ThemeResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ThemeResource;
use App\Filament\Traits\HasDescendingOrder;

class ListThemes extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ThemeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
