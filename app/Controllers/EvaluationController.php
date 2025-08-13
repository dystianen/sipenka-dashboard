<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AhpResultModel;
use App\Models\EvaluationResultModel;
use App\Models\PeriodModel;

class EvaluationController extends BaseController
{
    public function index()
    {
        $evaluationModel = new EvaluationResultModel();
        $ahpModel = new AhpResultModel();
        $periodModel = new PeriodModel();

        $period = $periodModel
            ->where('is_active', 1)
            ->first();

        $activePeriodId = $period['period_id'];

        // Ambil AHP result terbaru
        $latestAhp = $ahpModel
            ->where('period_id', $activePeriodId)
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!$latestAhp) {
            return view('evaluation-results/v_index', [
                'evaluations' => [],
                'message' => 'Data AHP tidak ditemukan.',
                'start_date' => '',
                'end_date' => ''
            ]);
        }

        // Ambil filter tanggal dari GET
        $startDate = $this->request->getGet('start_date');
        $endDate   = $this->request->getGet('end_date');

        $builder = $evaluationModel
            ->where('period_id', $activePeriodId)
            ->where('ahp_result_id', $latestAhp['ahp_result_id']);

        if ($startDate && $endDate) {
            $builder->where('created_at >=', $startDate . ' 00:00:00')
                ->where('created_at <=', $endDate . ' 23:59:59');
        }

        $evaluations = $builder->orderBy('final_score', 'DESC')->findAll();

        return view('evaluation-results/v_index', [
            'evaluations' => $evaluations,
            'message'     => null,
            'start_date'  => $startDate,
            'end_date'    => $endDate
        ]);
    }
}
