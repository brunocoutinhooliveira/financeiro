<?php

namespace App\Filament\Resources\Descriptions\Pages;

use App\Filament\Resources\Descriptions\DescriptionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDescription extends ViewRecord
{
    protected static string $resource = DescriptionResource::class;

    protected static ?string $title = 'Visualizar';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Visualizar'),
        ];
    }
}
