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

        // Ambil AHP result terbaru untuk periode
        $latestAhp = $ahpModel
            ->where('period_id', $activePeriodId)
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!$latestAhp) {
            return view('evaluation-results/v_index', ['evaluations' => [], 'message' => 'Data AHP tidak ditemukan.']);
        }

        $evaluations = $evaluationModel->getEvaluationWithTeachers($activePeriodId, $latestAhp['ahp_result_id']);

        // dd($evaluations);

        return view('evaluation-results/v_index', [
            'evaluations' => $evaluations,
            'message' => null
        ]);
    }
}
