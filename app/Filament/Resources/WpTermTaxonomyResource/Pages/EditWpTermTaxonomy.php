<?php

namespace App\Filament\Resources\WpTermTaxonomyResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\WpTermTaxonomyResource;

class EditWpTermTaxonomy extends EditRecord
{
    protected static string $resource = WpTermTaxonomyResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
