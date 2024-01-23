<?php

namespace App\Filament\Resources\FirewallRuleResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\FirewallRuleResource;

class EditFirewallRule extends EditRecord
{
    protected static string $resource = FirewallRuleResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
