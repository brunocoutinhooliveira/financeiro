<?php

namespace App\Filament\Resources\CostCenters\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CostCenterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
			->required()
			->unique(),
            ]);
    }
}
