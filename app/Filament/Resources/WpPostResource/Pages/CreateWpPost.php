<?php

namespace App\Filament\Resources\WpPostResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\WpPostResource;

class CreateWpPost extends CreateRecord
{
    protected static string $resource = WpPostResource::class;
}
