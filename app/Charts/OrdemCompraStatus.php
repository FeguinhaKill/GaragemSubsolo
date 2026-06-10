<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class OrdemCompraStatus
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $distribuicao = DB::table('ordem_compra')
            ->select('status', DB::raw('count(1) as qtd'))
            ->groupBy('status')
            ->get();

        $quantidades = [];
        $labels = [];

        $traducao = [
            'aberta'   => 'Aberta',
            'fechada'  => 'Fechada',
            'atrasado' => 'Atrasada',
        ];

        foreach ($distribuicao as $item) {
            $quantidades[] = $item->qtd;
            $labels[]      = $traducao[$item->status] ?? ucfirst($item->status);
        }

        return $this->chart->donutChart()
            ->setTitle('Ordens de Compra')
            ->setSubtitle('Distribuição por status')
            ->addData($quantidades)
            ->setLabels($labels);
    }
}
