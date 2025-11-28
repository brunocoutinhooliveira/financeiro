<?php

namespace App\Filament\Resources\Cities\Pages;

use App\Filament\Resources\Cities\CityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCity extends ViewRecord
{
	protected static string $resource = CityResource::class;

	protected static ?string $title = 'Visualizar';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Visualizar'),
        ];
    }
}
