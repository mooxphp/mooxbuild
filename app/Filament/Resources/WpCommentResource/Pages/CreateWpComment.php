<?php

namespace App\Filament\Resources\WpCommentResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\WpCommentResource;

class CreateWpComment extends CreateRecord
{
    protected static string $resource = WpCommentResource::class;
}
