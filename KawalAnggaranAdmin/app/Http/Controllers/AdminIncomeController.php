<?php

namespace App\Http\Controllers;

use App\Models\IncomePAD;
use App\Models\IncomeTKDD;
use App\Models\IncomeLainnya;
use Illuminate\Http\Request;

class AdminIncomeController extends BaseController
{
    protected $title = "Regional Income";
    protected $path = "admin.regIncome";

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

    public function storePAD(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
            'incomePAD.*.PAD' => 'required|string',
            'incomePAD.*.anggaran' => 'required|numeric',
            'incomePAD.*.realisasi' => 'required|numeric',
        ]);

        $mainModel = $this->getMainModel();

        foreach ($validatedData['incomePAD'] as $data) {
            $newRecord = new $mainModel();
            $newRecord->PAD = $data['PAD'];
            $newRecord->anggaran = $data['anggaran'];
            $newRecord->realisasi = $data['realisasi'];
            $newRecord->month = $validatedData['month'];
            $newRecord->year = $validatedData['year'];
            $newRecord->save();
        }

        return redirect()->route('admin.regIncome.index')
            ->with('success', 'New income records added successfully.');
    }

    public function storeTKDD(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
            'incomeTKDD.*.TKDD' => 'required|string',
            'incomeTKDD.*.anggaran' => 'required|numeric',
            'incomeTKDD.*.realisasi' => 'required|numeric',
        ]);

        $mainModel = IncomeTKDD::class; // Assuming your main model for this table is IncomeTKDD

        foreach ($validatedData['incomeTKDD'] as $data) {
            $newRecord = new $mainModel();
            $newRecord->TKDD = $data['TKDD'];
            $newRecord->anggaran = $data['anggaran'];
            $newRecord->realisasi = $data['realisasi'];
            $newRecord->month = $validatedData['month'];
            $newRecord->year = $validatedData['year'];
            $newRecord->save();
        }

        return redirect()->route('admin.regIncome.index')
            ->with('success', 'New TKDD records added successfully.');
    }

    public function storeLainnya(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
            'incomeLainnya.*.income_lainnya' => 'required|string',
            'incomeLainnya.*.anggaran' => 'required|numeric',
            'incomeLainnya.*.realisasi' => 'required|numeric',
        ]);

        $mainModel = IncomeLainnya::class; // Assuming your main model for this table is IncomeLainnya

        foreach ($validatedData['incomeLainnya'] as $data) {
            $newRecord = new $mainModel();
            $newRecord->income_lainnya = $data['income_lainnya'];
            $newRecord->anggaran = $data['anggaran'];
            $newRecord->realisasi = $data['realisasi'];
            $newRecord->month = $validatedData['month'];
            $newRecord->year = $validatedData['year'];
            $newRecord->save();
        }

        return redirect()->route('admin.regIncome.index')
            ->with('success', 'New income records added successfully.');
    }

    public function deletePAD(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $month = $validatedData['month'];
        $year = $validatedData['year'];

        // Example deletion logic
        // Replace with your actual deletion logic based on your model
        $deleted = IncomePAD::where('month', $month)
            ->where('year', $year)
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.regIncome.index')
                ->with('success', 'Records deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'No records found to delete.');
        }
    }

    public function deleteTKDD(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $month = $validatedData['month'];
        $year = $validatedData['year'];

        // Example deletion logic
        // Replace with your actual deletion logic based on your model
        $deleted = IncomeTKDD::where('month', $month)
            ->where('year', $year)
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.regIncome.index')
                ->with('success', 'Records deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'No records found to delete.');
        }
    }

    public function deleteLainnya(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $month = $validatedData['month'];
        $year = $validatedData['year'];

        // Example deletion logic
        // Replace with your actual deletion logic based on your model
        $deleted = IncomeLainnya::where('month', $month)
            ->where('year', $year)
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.regIncome.index')
                ->with('success', 'Records deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'No records found to delete.');
        }
    }

}
