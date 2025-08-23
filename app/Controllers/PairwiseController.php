<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriteriaModel;
use App\Models\PairwiseComparisonModel;
use App\Models\PeriodModel;

class PairwiseController extends BaseController
{
    protected $criteriaModel, $periodModel;

    public function __construct()
    {
        $this->criteriaModel = new CriteriaModel();
        $this->periodModel = new PeriodModel();
    }

    public function index()
    {
        $criteria = $this->criteriaModel->findAll();
        $periods = $this->periodModel->findAll();

        // Ambil period_id dari query (GET)
        $selectedPeriodId = $this->request->getGet('period_id');

        // kalau kosong, fallback ke periode aktif
        if (!$selectedPeriodId) {
            $activePeriod = $this->periodModel->where('is_active', 1)->first();
            $selectedPeriodId = $activePeriod ? $activePeriod['period_id'] : null;
        }

        $comparisonModel = new PairwiseComparisonModel();
        $savedComparisons = [];
        if ($selectedPeriodId) {
            $savedComparisons = $comparisonModel
                ->where('period_id', $selectedPeriodId)
                ->findAll();
        }

        // mapping [c1-c2] => value
        $comparisonMap = [];
        foreach ($savedComparisons as $row) {
            $comparisonMap[$row['criteria_id_1'] . '-' . $row['criteria_id_2']] = $row['comparison_value'];
        }

        // generate pasangan kriteria
        $pairs = [];
        for ($i = 0; $i < count($criteria); $i++) {
            for ($j = $i + 1; $j < count($criteria); $j++) {
                $pairs[] = [
                    'criteria1_id' => $criteria[$i]['category_id'],
                    'criteria1_name' => $criteria[$i]['name'],
                    'criteria2_id' => $criteria[$j]['category_id'],
                    'criteria2_name' => $criteria[$j]['name'],
                    'selected_value' => $comparisonMap[$criteria[$i]['category_id'] . '-' . $criteria[$j]['category_id']] ?? null
                ];
            }
        }

        return view('pairwise-comparison/v_index', [
            'pairs' => $pairs,
            'periods' => $periods,
            'selectedPeriodId' => $selectedPeriodId
        ]);
    }


    public function save()
    {
        $model = new PairwiseComparisonModel();
        $comparisons = $this->request->getPost('comparisons');
        $period_id = $this->request->getPost('period_id');

        // Pastikan data ada
        if (!$comparisons || !$period_id) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // Validasi periode
        $period = $this->periodModel->find($period_id);
        if (!$period) {
            return redirect()->back()->with('error', 'Periode tidak ditemukan.');
        }

        // hapus data lama agar tidak double
        $model->where('period_id', $period_id)->delete();

        // simpan ulang data pairwise
        foreach ($comparisons as $item) {
            $value = is_numeric($item['value'])
                ? floatval($item['value'])
                : eval("return " . $item['value'] . ";");

            $data = [
                'period_id'        => $period_id,
                'criteria_id_1'    => $item['criteria1_id'],
                'criteria_id_2'    => $item['criteria2_id'],
                'comparison_value' => $value,
                'created_by'       => session()->get('user_id') ?? 1,
            ];
            $model->insert($data);
        }

        return redirect()->to('/pairwise-comparison?period_id=' . $period_id)
            ->with('success', 'Data pairwise berhasil disimpan.');
    }
}
