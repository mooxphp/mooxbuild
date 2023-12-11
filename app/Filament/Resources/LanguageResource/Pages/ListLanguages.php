<?php

namespace App\Filament\Resources\LanguageResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\LanguageResource;

class ListLanguages extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = LanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
