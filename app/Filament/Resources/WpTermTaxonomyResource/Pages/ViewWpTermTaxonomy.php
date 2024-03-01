<?php

namespace App\Filament\Resources\WpTermTaxonomyResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\WpTermTaxonomyResource;

class ViewWpTermTaxonomy extends ViewRecord
{
    protected static string $resource = WpTermTaxonomyResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
