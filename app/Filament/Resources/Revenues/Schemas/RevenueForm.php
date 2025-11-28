<?php

namespace App\Filament\Resources\Revenues\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RevenueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('Data')
                    ->required(),
                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->label('Nome')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('cost_center_id')
                    ->label('Centro de Custo')
                    ->relationship('costCenter', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('description_id')
                    ->label('Descrição')
                    ->relationship('description', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('value')
                    ->label('Valor')
                    ->required()
                    ->numeric(),
                TextInput::make('nf'),
                Textarea::make('observation')
                    ->label('Observação')
                    ->columnSpanFull(),
            ]);
    }
}
