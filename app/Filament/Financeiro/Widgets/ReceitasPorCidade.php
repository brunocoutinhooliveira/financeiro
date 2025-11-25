<?php

namespace App\Filament\Financeiro\Widgets;

use App\Models\Revenue;
use Filament\Widgets\ChartWidget;

class ReceitasPorCidade extends ChartWidget
{
    protected ?string $heading = 'Receitas por Cidade';

    protected function getData(): array
    {
        $data = Revenue::selectRaw('cities.name as cidade, SUM(value) as total')
            ->join('cities', 'cities.id', '=', 'revenues.city_id')
            ->groupBy('cities.name')
            ->orderBy('total', 'desc')
            ->get();

        return [
            'labels' => $data->pluck('cidade')->all(),
            'datasets' => [
                [
                    'label' => 'Total (R$)',
                    'data' => $data->pluck('total')->all(),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
