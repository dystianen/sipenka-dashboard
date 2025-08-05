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

        $pairs = [];
        for ($i = 0; $i < count($criteria); $i++) {
            for ($j = $i + 1; $j < count($criteria); $j++) {
                $pairs[] = [
                    'criteria1_id' => $criteria[$i]['category_id'],
                    'criteria1_name' => $criteria[$i]['name'],
                    'criteria2_id' => $criteria[$j]['category_id'],
                    'criteria2_name' => $criteria[$j]['name'],
                ];
            }
        }

        $data = [
            'pairs' => $pairs,
            'periods' => $periods
        ];

        return view('pairwise_comparison/v_index', $data);
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

        $period = $this->periodModel
            ->where('is_active', 1)
            ->first();
        $activePeriodId = $period['period_id'];

        // dd($period_id, $comparisons);
        foreach ($comparisons as $item) {
            $value = is_numeric($item['value']) ? floatval($item['value']) : eval("return " . $item['value'] . ";");

            $data = [
                'period_id'        => $activePeriodId,
                'criteria_id_1'    => $item['criteria1_id'],
                'criteria_id_2'    => $item['criteria2_id'],
                'comparison_value' => $value,
                'created_by'       => session()->get('user_id') ?? 1,
            ];
            // dd($data);

            $model->insert($data);
        }

        return redirect()->to('/pairwise-comparison')->with('success', 'Data pairwise berhasil disimpan.');
    }
}
