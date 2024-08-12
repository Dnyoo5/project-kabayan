<?php

namespace App\Charts;

use App\Models\barang;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BarangChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $kategori = barang::get();
        $data = [
            $kategori->where('kategori','Pakaian')->count(),
            $kategori->where('kategori','Elektronik')->count(),
            $kategori->where('kategori','Peralatan Rumah')->count(),
        ];
        $label = [
            'Pakaian',
            'Elektronik',
            'Peralatan Rumah'
        ];
        return $this->chart->pieChart()
       
        ->setTitle('Data Kategori')
        ->setSubtitle(date('Y'))
        ->addData($data)
        ->setLabels($label);
    }
    
}
