<?php

namespace App\Http\Controllers;

use App\Models\IncomePAD;
use App\Models\IncomeTKDD;
use App\Models\IncomeLainnya;

class IncomeController extends BaseController
{
    protected $title = "Regional Income";
    protected $path = "dashboard.regIncome";

    protected function getMainModel()
    {
        return IncomePAD::class;
    }

    protected function getDataVariables()
    {
        return [
            'incomePAD' => IncomePAD::class,
            'incomeTKDD' => IncomeTKDD::class,
            'incomeLainnya' => IncomeLainnya::class,
        ];
    }

    protected function getSum($data)
    {
        $incomeTKDDRecord = $data['incomeTKDD']
            ->where('TKDD', 'Pendapatan Transfer Pemerintah Pusat')
            ->first();

        $TKDDValue = $incomeTKDDRecord ? (float) $incomeTKDDRecord->realisasi : 0;

        $incomeLainnyaRecord = $data['incomeLainnya']
            ->where('income_lainnya', 'Pendapatan Lainnya')
            ->first();

        $incomeLainnyaValue = $incomeLainnyaRecord ? (float) $incomeLainnyaRecord->realisasi : 0;
        
        $sumIncomePAD = $data['incomePAD']->sum('realisasi');
        $sumIncomeTKDD = $TKDDValue;
        $sumIncomeLainnya = $incomeLainnyaValue;

        $total = $sumIncomePAD + $sumIncomeTKDD + $sumIncomeLainnya;

        $labels = ["PAD", "TKDD", "Pendapatan Lainnya", "Others"];
        $values = [$sumIncomePAD, $TKDDValue, $incomeLainnyaValue, 0];

        return [
            'sumIncomePAD' => $sumIncomePAD,
            'TKDDValue' => $TKDDValue,
            'incomeLainnyaValue' => $incomeLainnyaValue,
            'total' => $total,
            'labels' => $labels,
            'values' => $values
        ];
    }
}
