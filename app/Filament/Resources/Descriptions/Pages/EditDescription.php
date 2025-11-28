<?php

namespace App\Filament\Resources\Descriptions\Pages;

use App\Filament\Resources\Descriptions\DescriptionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDescription extends EditRecord
{
    protected static string $resource = DescriptionResource::class;

    protected static ?string $title = 'Editar Descrição';

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()->label('Visualizar'),
            DeleteAction::make()->label('Deletar'),
        ];
    }
}
