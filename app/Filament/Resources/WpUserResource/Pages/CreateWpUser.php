<?php

namespace App\Filament\Resources\WpUserResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\WpUserResource;

class CreateWpUser extends CreateRecord
{
    protected static string $resource = WpUserResource::class;
}
