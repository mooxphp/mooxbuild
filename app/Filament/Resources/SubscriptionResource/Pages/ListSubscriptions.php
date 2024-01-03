<?php

namespace App\Filament\Resources\SubscriptionResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\SubscriptionResource;

class ListSubscriptions extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
