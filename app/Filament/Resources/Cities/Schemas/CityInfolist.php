<?php

namespace App\Filament\Resources\Cities\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label('Nome'),
                TextEntry::make('created_at')->label('Criado em')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')->label('Alterado em')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
