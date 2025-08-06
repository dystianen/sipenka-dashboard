<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AhpResultModel;
use App\Models\EvaluationResultModel;
use App\Models\PeriodModel;
use App\Models\TeacherModel;
use CodeIgniter\HTTP\ResponseInterface;

class EvaluationController extends BaseController
{
    public function index()
    {
        $evaluationModel = new EvaluationResultModel();
        $ahpModel = new AhpResultModel();

        // Ambil periode aktif
        $periodId = 4; // ganti jika perlu dinamis

        // Ambil AHP result terbaru untuk periode
        $latestAhp = $ahpModel
            ->where('period_id', $periodId)
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!$latestAhp) {
            return view('evaluation-results/v_index', ['evaluations' => [], 'message' => 'Data AHP tidak ditemukan.']);
        }

        $evaluations = $evaluationModel->getEvaluationWithTeachers($periodId, $latestAhp['ahp_result_id']);

        // dd($evaluations);

        return view('evaluation-results/v_index', [
            'evaluations' => $evaluations,
            'message' => null
        ]);
    }
}
