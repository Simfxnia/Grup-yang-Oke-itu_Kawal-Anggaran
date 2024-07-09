<?php

namespace App\Http\Controllers;

use App\Models\FinancingPenerimaan;
use App\Models\FinancingPengeluaran;

class FinancingController extends BaseController
{
    protected $title = "Regional Financing";
    protected $path = "dashboard.regFin";

    protected function getMainModel()
    {
        return FinancingPenerimaan::class;
    }

    protected function getDataVariables()
    {
        return [
            'financingTerima' => FinancingPenerimaan::class,
            'financingKeluar' => FinancingPengeluaran::class,
        ];
    }

    protected function getSum($data)
    {
        $sumFinancingTerima = $data['financingTerima']->sum('realisasi');
        $sumFinancingKeluar = $data['financingKeluar']->sum('realisasi');
        $totalFinancing = $sumFinancingTerima - $sumFinancingKeluar;

        $labels = ["Penerimaan Pembiayaan Daerah", "Pengeluaran Pembiayaan Daerah", "Others"];
        $values = [$sumFinancingTerima, $sumFinancingKeluar, 0];

        return [
            'sumFinancingTerima' => $sumFinancingTerima,
            'sumFinancingKeluar' => $sumFinancingKeluar,
            'totalFinancing' => $totalFinancing,
            'labels' => $labels,
            'values' => $values
        ];
    }
}
