<?php

namespace App\Filament\Resources\Cities\Pages;

use App\Filament\Resources\Cities\CityResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCity extends EditRecord
{
	protected static string $resource = CityResource::class;

	protected static ?string $title = 'Editar Cidade';

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label('Visualizar'),
            DeleteAction::make()->label('Deletar'),
        ];
    }
}
