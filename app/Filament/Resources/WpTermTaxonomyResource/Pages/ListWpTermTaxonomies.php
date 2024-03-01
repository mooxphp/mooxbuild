<?php

namespace App\Filament\Resources\WpTermTaxonomyResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WpTermTaxonomyResource;

class ListWpTermTaxonomies extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WpTermTaxonomyResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
