<?php

namespace App\Filament\Financeiro\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Expense;
use App\Models\Revenue;

class ResumoFinanceiro extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalDespesas = Expense::sum('value');
        $totalReceitas = Revenue::sum('value');
        $saldo = $totalReceitas - $totalDespesas;

        return [
            Stat::make('Total de Receitas', 'R$ ' . number_format($totalReceitas, 2, ',', '.'))
                ->color('success'),

            Stat::make('Total de Despesas', 'R$ ' . number_format($totalDespesas, 2, ',', '.'))
                ->color('danger'),

            Stat::make('Saldo Geral', 'R$ ' . number_format($saldo, 2, ',', '.'))
                ->color($saldo >= 0 ? 'success' : 'danger'),
        ];
    }
}
