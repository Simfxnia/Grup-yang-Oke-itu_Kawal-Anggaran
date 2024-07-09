<?php

namespace App\Http\Controllers;

use App\Models\ExpenditurePegawai;
use App\Models\ExpenditureBj;
use App\Models\ExpenditureModal;
use App\Models\ExpenditureLainnya;
use Illuminate\Http\Request;

class AdminExpenditureController extends BaseController
{
    protected $title = "Regional Expenditure";
    protected $path = "admin.regExp";

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

    public function storePegawai(Request $request)
    {
        $validatedData = $request->validate([
            'belanja_pegawai' => 'required|string',
            'anggaran' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $newRecord = new ExpenditurePegawai();
        $newRecord->belanja_pegawai = $validatedData['belanja_pegawai'];
        $newRecord->anggaran = $validatedData['anggaran'];
        $newRecord->realisasi = $validatedData['realisasi'];
        $newRecord->month = $validatedData['month'];
        $newRecord->year = $validatedData['year'];
        $newRecord->save();

        return redirect()->route('admin.regExp.index')
            ->with('success', 'New expenditure record added successfully.');
    }

    public function storeBj(Request $request)
    {
        $validatedData = $request->validate([
            'barang_jasa' => 'required|string',
            'anggaran' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $newRecord = new ExpenditureBJ();
        $newRecord->barang_jasa = $validatedData['barang_jasa'];
        $newRecord->anggaran = $validatedData['anggaran'];
        $newRecord->realisasi = $validatedData['realisasi'];
        $newRecord->month = $validatedData['month'];
        $newRecord->year = $validatedData['year'];
        $newRecord->save();

        return redirect()->route('admin.regExp.index')
            ->with('success', 'New expenditure record added successfully.');
    }

    public function storeModal(Request $request)
    {
        $validatedData = $request->validate([
            'modal' => 'required|string',
            'anggaran' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $newRecord = new ExpenditureModal();
        $newRecord->modal = $validatedData['modal'];
        $newRecord->anggaran = $validatedData['anggaran'];
        $newRecord->realisasi = $validatedData['realisasi'];
        $newRecord->month = $validatedData['month'];
        $newRecord->year = $validatedData['year'];
        $newRecord->save();

        return redirect()->route('admin.regExp.index')
            ->with('success', 'New expenditure record added successfully.');
    }

    public function deletePegawai(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $month = $validatedData['month'];
        $year = $validatedData['year'];

        // Example deletion logic
        // Replace with your actual deletion logic based on your model
        $deleted = ExpenditurePegawai::where('month', $month)
            ->where('year', $year)
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.regExp.index')
                ->with('success', 'Records deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'No records found to delete.');
        }
    }

    public function deleteBj(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $month = $validatedData['month'];
        $year = $validatedData['year'];

        // Example deletion logic
        // Replace with your actual deletion logic based on your model
        $deleted = ExpenditureBj::where('month', $month)
            ->where('year', $year)
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.regExp.index')
                ->with('success', 'Records deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'No records found to delete.');
        }
    }

    public function deleteModal(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $month = $validatedData['month'];
        $year = $validatedData['year'];

        // Example deletion logic
        // Replace with your actual deletion logic based on your model
        $deleted = ExpenditureModal::where('month', $month)
            ->where('year', $year)
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.regExp.index')
                ->with('success', 'Records deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'No records found to delete.');
        }
    }
}
