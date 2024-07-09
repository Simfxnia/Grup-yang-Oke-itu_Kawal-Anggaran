<?php

namespace App\Http\Controllers;

use App\Models\FinancingPenerimaan;
use App\Models\FinancingPengeluaran;
use Illuminate\Http\Request;

class AdminFinancingController extends BaseController
{
    protected $title = "Regional Financing";
    protected $path = "admin.regFin";

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

    public function storePenerimaan(Request $request)
    {
        $validatedData = $request->validate([
            'records.*.penerimaan_daerah' => 'required|string',
            'records.*.anggaran' => 'required|numeric',
            'records.*.realisasi' => 'required|numeric',
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        foreach ($validatedData['records'] as $data) {
            $newRecord = new FinancingPenerimaan();
            $newRecord->penerimaan_daerah = $data['penerimaan_daerah'];
            $newRecord->anggaran = $data['anggaran'];
            $newRecord->realisasi = $data['realisasi'];
            $newRecord->month = $validatedData['month'];
            $newRecord->year = $validatedData['year'];
            $newRecord->save();
        }

        return redirect()->route('admin.regFin.index')
            ->with('success', 'New financing records added successfully.');
    }

    public function storePengeluaran(Request $request)
    {
        $validatedData = $request->validate([
            'records.*.pengeluaran_daerah' => 'required|string',
            'records.*.anggaran' => 'required|numeric',
            'records.*.realisasi' => 'required|numeric',
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $month = $validatedData['month'];
        $year = $validatedData['year'];

        foreach ($validatedData['records'] as $data) {
            $newRecord = new FinancingPengeluaran();
            $newRecord->pengeluaran_daerah = $data['pengeluaran_daerah'];
            $newRecord->anggaran = $data['anggaran'];
            $newRecord->realisasi = $data['realisasi'];
            $newRecord->month = $month;
            $newRecord->year = $year;
            $newRecord->save();
        }

        return redirect()->route('admin.regFin.index')
            ->with('success', 'New financing records added successfully.');
    }

    public function deletePenerimaan(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $month = $validatedData['month'];
        $year = $validatedData['year'];

        // Example deletion logic
        // Replace with your actual deletion logic based on your model
        $deleted = FinancingPenerimaan::where('month', $month)
            ->where('year', $year)
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.regFin.index')
                ->with('success', 'Records deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'No records found to delete.');
        }
    }

    public function deletePengeluaran(Request $request)
    {
        $validatedData = $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $month = $validatedData['month'];
        $year = $validatedData['year'];

        // Example deletion logic
        // Replace with your actual deletion logic based on your model
        $deleted = FinancingPengeluaran::where('month', $month)
            ->where('year', $year)
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.regFin.index')
                ->with('success', 'Records deleted successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'No records found to delete.');
        }
    }
}
