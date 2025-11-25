<?php

namespace App\Filament\Financeiro\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Expense;

class DespesasPorCentro extends ChartWidget
{
    protected ?string $heading = 'Despesas por Centro de Custo';

    protected function getData(): array
    {
        $data = Expense::selectRaw('cost_centers.name as centro, SUM(value) as total')
            ->join('cost_centers', 'cost_centers.id', '=', 'expenses.cost_center_id')
            ->groupBy('cost_centers.name')
            ->orderBy('total', 'desc')
            ->get();

        return [
            'labels' => $data->pluck('centro'),
            'datasets' => [
                [
                    'label' => 'Total (R$)',
                    'data' => $data->pluck('total'),
                ]
            ]
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}