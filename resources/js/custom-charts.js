// resources/js/custom-charts.js

import Chart from 'chart.js/auto'
import ChartDataLabels from 'chartjs-plugin-datalabels'

// Registra o plugin para que ele seja aplicado em todos os gráficos
Chart.register(ChartDataLabels);

// Define configurações GLOBAIS para o plugin de datalabels
// Isso será aplicado a todos os gráficos que usarem o plugin.
Chart.defaults.set('plugins.datalabels', {
    display: true, // Garante que os labels sejam exibidos por padrão
    anchor: 'end',
    align: 'end',
    color: '#DC2626', // Vermelho (red-600)
    font: {
        weight: 'bold',
    },
    rotation: -90, // Gira o texto para ficar na vertical
    padding: {
        top: 25 // Espaço para não cortar o texto
    },
    formatter: (value) => {
        // Formata como moeda BRL
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value);
    }
});
