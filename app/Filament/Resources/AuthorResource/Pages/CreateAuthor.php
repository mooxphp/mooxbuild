<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AuthorResource;

class CreateAuthor extends CreateRecord
{
    protected static string $resource = AuthorResource::class;
}
