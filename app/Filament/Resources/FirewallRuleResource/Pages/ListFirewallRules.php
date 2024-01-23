<?php

namespace App\Filament\Resources\FirewallRuleResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\FirewallRuleResource;

class ListFirewallRules extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = FirewallRuleResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
