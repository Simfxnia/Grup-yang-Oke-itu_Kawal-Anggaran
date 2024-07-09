<?php

namespace App\Http\Controllers;

use App\Models\ExpenditurePegawai;
use App\Models\ExpenditureBj;
use App\Models\ExpenditureModal;
use App\Models\ExpenditureLainnya;

class ExpenditureController extends BaseController
{
    protected $title = "Regional Expenditure";
    protected $path = "dashboard.regExp";

    protected function getMainModel()
    {
        return ExpenditurePegawai::class;
    }

    protected function getDataVariables()
    {
        return [
            'expenditurePegawai' => ExpenditurePegawai::class,
            'expenditureBj' => ExpenditureBj::class,
            'expenditureModal' => ExpenditureModal::class,
            'expenditureLainnya' => ExpenditureLainnya::class,
        ];
    }

    protected function getSum($data)
    {
        $sumExpenditurePegawai = $data['expenditurePegawai']->sum('realisasi');
        $sumExpenditureBj = $data['expenditureBj']->sum('realisasi');
        $sumExpenditureModal = $data['expenditureModal']->sum('realisasi');
        $sumExpenditureLainnya = $data['expenditureLainnya']->sum('realisasi');

        $totalExpenditure = $sumExpenditurePegawai + $sumExpenditureBj + $sumExpenditureModal + $sumExpenditureLainnya;

        $labels = ["Belanja Pegawai", "Belanja Barang dan Jasa", "Belanja Modal", "Belanja Lainnya", "Others"];
        $values = [$sumExpenditurePegawai, $sumExpenditureBj, $sumExpenditureModal, $sumExpenditureLainnya, 0];

        return [
            'sumExpenditurePegawai' => $sumExpenditurePegawai,
            'sumExpenditureBj' => $sumExpenditureBj,
            'sumExpenditureModal' => $sumExpenditureModal,
            'sumExpenditureLainnya' => $sumExpenditureLainnya,
            'totalExpenditure' => $totalExpenditure,
            'labels' => $labels,
            'values' => $values
        ];
    }
}
