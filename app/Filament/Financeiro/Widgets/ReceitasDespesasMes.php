<?php

namespace App\Filament\Financeiro\Widgets;

use App\Models\Expense;
use App\Models\Revenue;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class ReceitasDespesasMes extends ChartWidget
{
    protected ?string $heading = 'Receitas x Despesas por Mês';

    protected function getData(): array
    {
        $months = collect(range(1, 12));

        $despesas = $months->map(
            fn($m) =>
            Expense::whereMonth('date', $m)->sum('value')
        );

        $receitas = $months->map(
            fn($m) =>
            Revenue::whereMonth('date', $m)->sum('value')
        );

        return [
            'labels' => $months->map(fn($m) => Carbon::create(null, $m)->format('M')),
            'datasets' => [
                [
                    'label' => 'Receitas',
                    'data' => $receitas,
                    'borderColor' => '#00b894',
                ],
                [
                    'label' => 'Despesas',
                    'data' => $despesas,
                    'borderColor' => '#d63031',
                ],
            ]
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
