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
                    ->required(),
                Select::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('cost_center_id')
                    ->label('Cost Center')
                    ->relationship('costCenter', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('description_id')
                    ->label('Description')
                    ->relationship('description', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('value')
                    ->required()
                    ->numeric(),
                TextInput::make('nf'),
                Textarea::make('observation')
                    ->columnSpanFull(),
            ]);
    }
}
