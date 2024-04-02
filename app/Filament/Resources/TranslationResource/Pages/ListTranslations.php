<?php

namespace App\Filament\Resources\TranslationResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\TranslationResource;

class ListTranslations extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = TranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
