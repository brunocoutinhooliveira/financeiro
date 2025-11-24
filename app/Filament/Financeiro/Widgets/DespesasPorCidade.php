<?php

namespace App\Filament\Financeiro\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;

class DespesasPorCidade extends ChartWidget
{
    protected ?string $heading = 'Despesas por Cidade';

    protected function getData(): array
    {
        $data = Expense::selectRaw('cities.name as cidade, SUM(value) as total')
            ->join('cities', 'cities.id', '=', 'expenses.city_id')
            ->groupBy('cities.name')
            ->orderBy('total', 'desc')
            ->get();

        return [
            'labels' => $data->pluck('cidade')->all(),
            'datasets' => [
                [
                    'label' => 'Total (R$)',
                    'data' => $data->pluck('total')->map(fn ($v) => (float) $v)->all(),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
