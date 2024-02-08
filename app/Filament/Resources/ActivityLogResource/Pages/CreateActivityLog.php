<?php

namespace App\Filament\Resources\ActivityLogResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ActivityLogResource;

class CreateActivityLog extends CreateRecord
{
    protected static string $resource = ActivityLogResource::class;
}
