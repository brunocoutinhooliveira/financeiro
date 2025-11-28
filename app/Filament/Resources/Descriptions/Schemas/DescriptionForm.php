<?php

namespace App\Filament\Resources\Descriptions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DescriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
			->required()
			->unique(),
            ]);
    }
}
