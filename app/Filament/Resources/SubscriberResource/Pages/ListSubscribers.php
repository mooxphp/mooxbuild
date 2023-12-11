<?php

namespace App\Filament\Resources\SubscriberResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\SubscriberResource;

class ListSubscribers extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = SubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
