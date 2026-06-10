<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class EstoqueStatus
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PolarAreaChart
    {
        $marcas = DB::table('estoques')
            ->join('produtos', 'estoques.produto_id', '=', 'produtos.id')
            ->select('produtos.marca as marca', DB::raw('count(*) as qtd'))
            ->groupBy('produtos.marca')
            ->orderByDesc('qtd')
            ->get();

        $labels = [];
        $quantidades = [];

        foreach ($marcas as $marca) {
            $labels[] = $marca->marca ?: 'Sem marca';
            $quantidades[] = (int) $marca->qtd;
        }

        return $this->chart->polarAreaChart()
            ->setTitle('Marcas no Estoque')
            ->setSubtitle('Frequência de cada marca')
            ->addData($quantidades)
            ->setLabels($labels);
    }
}
