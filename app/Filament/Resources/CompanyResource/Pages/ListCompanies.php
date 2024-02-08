<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\CompanyResource;

class ListCompanies extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
