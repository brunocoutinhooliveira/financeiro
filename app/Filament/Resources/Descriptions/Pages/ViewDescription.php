<?php

namespace App\Filament\Resources\Descriptions\Pages;

use App\Filament\Resources\Descriptions\DescriptionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDescription extends ViewRecord
{
    protected static string $resource = DescriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
