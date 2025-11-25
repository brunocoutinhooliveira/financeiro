<?php

namespace App\Filament\Resources\Revenues\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class RevenuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('city.name')->label('City')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('costCenter.name')->label('Cost Center')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description.name')->label('Description')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nf')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // 1) Filtro por Período
                Filter::make('date_range')
                    ->label('Período')
                    ->form([
                        DatePicker::make('from')->label('De'),
                        DatePicker::make('until')->label('Até'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('date', '>=', $data['from']))
                            ->when($data['until'], fn($q) => $q->whereDate('date', '<=', $data['until']));
                    }),

                // 2) Filtro por Cidade
                SelectFilter::make('city_id')
                    ->label('Cidade')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload(),

                // 3) Filtro por Centro de Custo
                SelectFilter::make('cost_center_id')
                    ->label('Centro de Custo')
                    ->relationship('costCenter', 'name')
                    ->searchable()
                    ->preload(),

                // 3) Filtro por Centro de Custo
                SelectFilter::make('description_id')
                    ->label('Descrição')
                    ->relationship('description', 'name')
                    ->searchable()
                    ->preload(),

                // 4) Filtro por Valor
                Filter::make('value_range')
                    ->label('Valor')
                    ->form([
                        TextInput::make('min')->label('Mínimo')->numeric(),
                        TextInput::make('max')->label('Máximo')->numeric(),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['min'], fn($q) => $q->where('value', '>=', $data['min']))
                            ->when($data['max'], fn($q) => $q->where('value', '<=', $data['max']));
                    }),

                // 5) Filtro por Descrição (Contém)
                Filter::make('descricao')
                    ->label('Descrição contém')
                    ->form([
                        TextInput::make('text')->label('Texto'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['text'],
                            fn($q) => $q->where('description', 'like', '%' . $data['text'] . '%')
                        );
                    }),

                // 6) Filtro por Mês e Ano
                Filter::make('month_year')
                    ->label('Mês / Ano')
                    ->form([
                        Select::make('month')
                            ->label('Mês')
                            ->options([
                                '1' => 'Janeiro',
                                '2' => 'Fevereiro',
                                '3' => 'Março',
                                '4' => 'Abril',
                                '5' => 'Maio',
                                '6' => 'Junho',
                                '7' => 'Julho',
                                '8' => 'Agosto',
                                '9' => 'Setembro',
                                '10' => 'Outubro',
                                '11' => 'Novembro',
                                '12' => 'Dezembro',
                            ]),

                        Select::make('year')
                            ->label('Ano')
                            ->options(array_combine(
                                range(date('Y') - 5, date('Y') + 1),
                                range(date('Y') - 5, date('Y') + 1)
                            )),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['month'], fn($q) => $q->whereMonth('date', $data['month']))
                            ->when($data['year'], fn($q) => $q->whereYear('date', $data['year']));
                    }),

                // 7) Filtro Acima da Média
                Filter::make('above_average')
                    ->label('Acima da Média')
                    ->toggle()
                    ->query(function ($query, $data) {
                        $media = $query->avg('value');
                        return $query->when($data, fn($q) => $q->where('value', '>', $media));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
