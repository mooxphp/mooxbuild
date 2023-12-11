<?php

namespace App\Filament\Resources\PageTemplateResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\PageTemplateResource;

class ListPageTemplates extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = PageTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
