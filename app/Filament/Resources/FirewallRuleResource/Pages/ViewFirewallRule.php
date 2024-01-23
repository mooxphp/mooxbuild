<?php

namespace App\Filament\Resources\FirewallRuleResource\Pages;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\FirewallRuleResource;

class ViewFirewallRule extends ViewRecord
{
    protected static string $resource = FirewallRuleResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
