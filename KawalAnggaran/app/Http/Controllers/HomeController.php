<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LucianoTonet\GroqLaravel\Facades\Groq;
use App\Models\IncomePAD;
use App\Models\IncomeTKDD;
use App\Models\IncomeLainnya;
use App\Models\ExpenditurePegawai;
use App\Models\ExpenditureBj;
use App\Models\ExpenditureModal;
use App\Models\ExpenditureLainnya;
use App\Models\FinancingPenerimaan;
use App\Models\FinancingPengeluaran;

class HomeController extends Controller
{
    protected $title = "Kawal Anggaran | Home";
    protected $path = "homepage.homepage";

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
            'expenditurePegawai' => ExpenditurePegawai::class,
            'expenditureBj' => ExpenditureBj::class,
            'expenditureModal' => ExpenditureModal::class,
            'expenditureLainnya' => ExpenditureLainnya::class,
            'financingTerima' => FinancingPenerimaan::class,
            'financingKeluar' => FinancingPengeluaran::class,
        ];
    }

    protected function fetchData($selectedYear)
    {
        $monthOrder = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $results = [];
        foreach ($this->getDataVariables() as $variable => $model) {
            $results[$variable] = $model::where('year', $selectedYear)
                ->whereIn('month', $monthOrder)
                ->get();
        }

        return $results;
    }

    protected function getSum($data)
    {
        $sumIncomePAD = $data['incomePAD']
            ->whereIn('PAD', [
                'Pajak Daerah', 
                'Retribusi Daerah', 
                'Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan', 
                'Lain-Lain PAD yang Sah'
            ])
            ->groupBy('PAD')
            ->map(function ($group) {
                return $group->first()->anggaran;
            })
            ->sum();

        $incomeTKDDRecord = $data['incomeTKDD']
            ->where('TKDD', 'Pendapatan Transfer Pemerintah Pusat')
            ->first();
        $TKDDValue = $incomeTKDDRecord ? $incomeTKDDRecord->anggaran : 0;

        $incomeLainnyaRecord = $data['incomeLainnya']
            ->where('income_lainnya', 'Pendapatan Lainnya')
            ->first();
        $incomeLainnyaValue = $incomeLainnyaRecord ? $incomeLainnyaRecord->anggaran : 0;

        $sumIncomeTKDD = $TKDDValue;
        $sumIncomeLainnya = $incomeLainnyaValue;

        $totalAnggaranIncome = $sumIncomePAD + $sumIncomeTKDD + $sumIncomeLainnya;

        $singleExpenditurePegawai = $data['expenditurePegawai']
            ->where('belanja_pegawai', 'Belanja Pegawai')
            ->first();
        $singleExpenditureBj = $data['expenditureBj']
            ->where('barang_jasa', 'Belanja Barang dan Jasa')
            ->first();
        $singleExpenditureModal = $data['expenditureModal']
            ->where('modal', 'Belanja Modal')
            ->first();
        $singleExpenditureLainnya = $data['expenditureLainnya']
            ->whereIn('expenditure_lainnya', [
            'Belanja Bagi Hasil', 
            'Belanja Bantuan Keuangan', 
            'Belanja Subsidi', 
            'Belanja Hibah',
            'Belanja Bantuan Sosial',
            'Belanja Tidak Terduga'
        ])
        ->groupBy('expenditure_lainnya')
        ->map(function ($group) {
            return $group->first()->anggaran;
        })
        ->sum();

        $totalAnggaranExp = (
            ($singleExpenditurePegawai ? $singleExpenditurePegawai->anggaran : 0) + 
            ($singleExpenditureBj ? $singleExpenditureBj->anggaran : 0) + 
            ($singleExpenditureModal ? $singleExpenditureModal->anggaran : 0) +
            $singleExpenditureLainnya
        );

        $singleFinancingTerima = $data['financingTerima']
            ->whereIn('penerimaan_daerah', [
            'Sisa Lebih Perhitungan Anggaran Tahun Sebelumnya', 
            'Penerimaan Kembali Pemberian Pinjaman Daerah'
        ])
        ->groupBy('penerimaan_daerah')
        ->map(function ($group) {
            return $group->first()->anggaran;
        })
        ->sum();
        $singleFinancingKeluar = $data['financingKeluar']
            ->whereIn('pengeluaran_daerah', [
            'Penyertaan Modal Daerah', 
            'Pemberian Pinjaman Daerah'
        ])
        ->groupBy('pengeluaran_daerah')
        ->map(function ($group) {
            return $group->first()->anggaran;
        })
        ->sum();
        $totalAnggaranFin = $singleFinancingTerima - $singleFinancingKeluar;

        return [
            'totalAnggaranIncome' => $totalAnggaranIncome,
            'totalAnggaranExp' => $totalAnggaranExp,
            'totalAnggaranFin' => $totalAnggaranFin,
        ];
    }

    protected function assignRealisasiPerMonth($data, $selectedYear)
    {
        $monthOrder = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $realisasiPerMonth = [];

        foreach ($monthOrder as $month) {
            $realisasiPerMonth[$month] = $data['expenditurePegawai']
                    ->where('month', $month)->where('year', $selectedYear)->sum('realisasi') +
                $data['expenditureBj']
                    ->where('month', $month)->where('year', $selectedYear)->sum('realisasi') +
                $data['expenditureModal']
                    ->where('month', $month)->where('year', $selectedYear)->sum('realisasi') +
                $data['expenditureLainnya']
                    ->where('month', $month)->where('year', $selectedYear)->sum('realisasi');
        }

        return $realisasiPerMonth;
    }

    protected function getPath()
    {
        return $this->path;
    }

    public function getChatCompletion($userQuery)
    {
        $dataA = IncomePAD::all();
        $dataB = IncomeTKDD::all();
        $dataC = IncomeLainnya::all();

        // Convert data to a format that can be sent to the LLM
        $formattedData = $this->formatDataForLLM($dataA, $dataB, $dataC);

        $groq = new Groq();

        $chatCompletion = $groq->chat()->completions()->create([
            'model' => 'llama3-8b-8192', // llama3-8b-8192, llama3-70b-8192, llama2-70b-4096, mixtral-8x7b-32768, gemma-7b-it
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $userQuery . $formattedData . '. Anggaran means budget and realisasi means spending. Make it much playful so the user is immersed to the content you display. If the user prompt out of the topic queries just say that we are sorry we cant provide that with a smiley face.'
                ]
            ],
        ]);

        $response = $chatCompletion['choices'][0]['message']['content'];
        return $response;
    }

    private function formatDataForLLM($dataA, $dataB, $dataC)
    {
        // Convert the data to a JSON string or any format suitable for the LLM
        return json_encode([
            'incomePAD' => $dataA,
            'incomeTKDD' => $dataB,
            'incomeLainnya' => $dataC,
        ]);
    }

    public function index(Request $request)
    {
        $currentMonth = date('F');
        $currentYear = date('Y');

        $data = $this->fetchData($currentYear);
        $sums = $this->getSum($data);
        $realisasiPerMonth = $this->assignRealisasiPerMonth($data, $currentYear);

        $response = $request->input('userQuery') 
            ? $this->getChatCompletion($request->input('userQuery')) 
            : "Hello! I am your AI assistant. Ask me anything you want to know about the goverments spending!";

        return view($this->getPath(), array_merge($data, $sums, [
            'selectedMonth' => $currentMonth,
            'selectedYear' => $currentYear,
            'realisasiPerMonth' => $realisasiPerMonth,
            'title' => $this->title,
            'response' => $response
        ]));
    }
}
