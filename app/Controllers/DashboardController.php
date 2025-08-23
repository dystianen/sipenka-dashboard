<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EvaluationResultModel;
use App\Models\TeacherModel;

class DashboardController extends BaseController
{
    protected $teacherModel;
    protected $evaluationModel;

    public function __construct()
    {
        $this->teacherModel    = new TeacherModel();
        $this->evaluationModel = new EvaluationResultModel();
    }

    public function index()
    {
        // Jumlah guru
        $jumlahGuru = $this->teacherModel->countAllResults();

        // Rata-rata nilai
        $avgScore = $this->evaluationModel
            ->selectAvg('normalized_score', 'avg_score')
            ->first();

        // Ranking tertinggi (ambil yang rank = 1)
        $topRank = $this->evaluationModel
            ->select('evaluation_results.*, users.name as teacher_name')
            ->join('teachers', 'teachers.teacher_id = evaluation_results.teacher_id')
            ->join('users', 'users.user_id = teachers.user_id')
            ->where('rank', 1)
            ->first();

        $data = [
            'jumlahGuru' => $jumlahGuru,
            'avgScore'   => round($avgScore['avg_score'] ?? 0, 2),
            'topRank'    => $topRank
        ];

        return view('v_dashboard', $data);
    }
}
