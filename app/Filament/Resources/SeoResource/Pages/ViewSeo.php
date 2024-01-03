<?php

namespace App\Filament\Resources\SeoResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\SeoResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSeo extends ViewRecord
{
    protected static string $resource = SeoResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
