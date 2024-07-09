<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $title;
    protected $path;
    
    protected function fetchData($selectedMonth = null, $selectedYear = null)
    {
        $monthOrder = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $mainModel = $this->getMainModel();
        $months = $mainModel::select('month')->distinct()->get()->pluck('month')->toArray();
        usort($months, function($a, $b) use ($monthOrder) {
            return array_search($a, $monthOrder) - array_search($b, $monthOrder);
        });

        $years = $mainModel::select('year')->distinct()->orderBy('year', 'desc')->get();

        $results = [];
        foreach ($this->getDataVariables() as $variable => $model) {
            $results[$variable] = collect();
        }

        if ($selectedMonth && $selectedYear) {
            foreach ($this->getDataVariables() as $variable => $model) {
                $results[$variable] = $model::where('month', $selectedMonth)->where('year', $selectedYear)->get();
            }
        }

        return compact('months', 'years') + $results;
    }

    protected function getPath()
    {
        return $this->path;
    }

    protected function getSum($results)
    {
        return [];
    }

    public function index()
    {
        $currentMonth = date('F');
        $currentYear = date('Y');

        $data = $this->fetchData($currentMonth, $currentYear);
        $sums = $this->getSum($data);

        return view($this->getPath(), array_merge($data, $sums, [
            'selectedMonth' => $currentMonth,
            'selectedYear' => $currentYear,
            'title' => $this->title
        ]));
    }

    public function filter(Request $request)
    {
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');

        $data = $this->fetchData($selectedMonth, $selectedYear);
        $sums = $this->getSum($data);

        return view($this->getPath(), array_merge($data, $sums, [
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'title' => $this->title
        ]));
    }

    abstract protected function getMainModel();
    abstract protected function getDataVariables();
}
