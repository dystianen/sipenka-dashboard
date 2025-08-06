<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AhpResultModel;
use App\Models\CriteriaModel;
use App\Models\EvaluationResultModel;
use App\Models\PairwiseComparisonModel;
use App\Models\PeriodModel;
use App\Models\TeacherModel;
use App\Models\TeacherQuestionScoreModel;

class AhpResultsController extends BaseController
{
    protected $ahpResultModel, $teacherScoreModel, $evaluationModel, $periodModel, $teacherModel, $categoryModel, $comparisonModel;

    public function __construct()
    {
        $this->ahpResultModel = new AhpResultModel();
        $this->teacherScoreModel = new TeacherQuestionScoreModel();
        $this->evaluationModel = new EvaluationResultModel();
        $this->periodModel = new PeriodModel();
        $this->teacherModel = new TeacherModel();
        $this->categoryModel = new CriteriaModel();
        $this->comparisonModel = new PairwiseComparisonModel();
    }

    private function getRandomIndex($n)
    {
        $riTable = [
            1 => 0.00,
            2 => 0.00,
            3 => 0.58,
            4 => 0.90,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.45,
            10 => 1.49,
        ];
        return $riTable[$n] ?? 1.5;
    }

    public function generateEvaluationResults()
    {
        // Ambil periode aktif
        $period = $this->periodModel->where('is_active', 1)->first();
        if (!$period) {
            return redirect()->back()->with('error', 'Periode aktif tidak ditemukan.');
        }
        $periodId = $period['period_id'];

        // Ambil hasil AHP terbaru untuk periode ini
        $ahpResult = $this->ahpResultModel
            ->where('period_id', $periodId)
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!$ahpResult) {
            return redirect()->back()->with('error', 'Belum ada hasil AHP.');
        }

        $weights = json_decode($ahpResult['weights'], true);
        $teachers = $this->teacherModel->findAll();
        $results = [];

        foreach ($teachers as $teacher) {
            $teacherId = $teacher['teacher_id'];

            // Ambil skor rata-rata per kategori untuk guru ini
            $scores = $this->teacherScoreModel
                ->select('questions.category_id, AVG(teacher_question_scores.score) as avg_score')
                ->join('questions', 'questions.question_id = teacher_question_scores.question_id')
                ->where('teacher_question_scores.period_id', $periodId)
                ->where('teacher_question_scores.teacher_id', $teacherId)
                ->groupBy('questions.category_id')
                ->findAll();

            $finalScore = 0;

            foreach ($scores as $s) {
                $categoryId = $s['category_id'];
                $avgScore = floatval($s['avg_score']);
                $weight = $weights[$categoryId] ?? 0;
                $finalScore += $avgScore * $weight;
            }

            $results[] = [
                'teacher_id'    => $teacherId,
                'final_score'   => $finalScore,
                'ahp_result_id' => $ahpResult['ahp_result_id'],
                'period_id'     => $periodId
            ];
        }

        // Urutkan dan beri ranking
        usort($results, fn($a, $b) => $b['final_score'] <=> $a['final_score']);
        $rank = 1;
        foreach ($results as &$r) {
            $r['rank'] = $rank++;
        }
        unset($r);

        // Hapus hasil sebelumnya untuk periode ini
        $this->evaluationModel->where('period_id', $periodId)->delete();

        // Simpan hasil baru
        foreach ($results as $r) {
            $this->evaluationModel->insert([
                'teacher_id'    => $r['teacher_id'],
                'ahp_result_id' => $r['ahp_result_id'],
                'period_id'     => $r['period_id'],
                'final_score'   => $r['final_score'],
                'rank'          => $r['rank']
            ]);
        }

        return redirect()->to('/evaluation-results')->with('success', 'Hasil evaluasi berhasil disimpan.');
    }



    public function calculateAHP()
    {
        $period = $this->periodModel
            ->where('is_active', 1)
            ->first();

        $activePeriodId = $period['period_id'];

        $categories = $this->categoryModel->findAll();
        $categoryIds = array_column($categories, 'category_id');
        $n = count($categoryIds);

        // Inisialisasi matriks pairwise
        $matrix = array_fill(0, $n, array_fill(0, $n, 1.0));

        // Mapping kategori ke indeks matriks
        $categoryIndexMap = array_flip($categoryIds);

        // Ambil data pairwise dari DB
        $comparisons = $this->comparisonModel->where('period_id', $activePeriodId)->findAll();

        // Isi matriks berdasarkan data
        foreach ($comparisons as $row) {
            $i = $categoryIndexMap[$row['criteria_id_1']];
            $j = $categoryIndexMap[$row['criteria_id_2']];
            $value = floatval($row['comparison_value']);

            $matrix[$i][$j] = $value;
            $matrix[$j][$i] = 1 / $value;
        }

        // Hitung jumlah tiap kolom
        $columnSums = array_fill(0, $n, 0);
        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $n; $i++) {
                $columnSums[$j] += $matrix[$i][$j];
            }
        }

        // Normalisasi matriks
        $normalized = [];
        for ($i = 0; $i < $n; $i++) {
            $normalized[$i] = [];
            for ($j = 0; $j < $n; $j++) {
                $normalized[$i][$j] = $matrix[$i][$j] / $columnSums[$j];
            }
        }

        // Hitung bobot (rata-rata tiap baris)
        $weights = [];
        for ($i = 0; $i < $n; $i++) {
            $weights[$categoryIds[$i]] = array_sum($normalized[$i]) / $n;
        }

        // Hitung lambda max
        $lambdaMax = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $matrix[$i][$j] * $weights[$categoryIds[$j]];
            }
            $lambdaMax += $sum / $weights[$categoryIds[$i]];
        }
        $lambdaMax /= $n;

        // Hitung Consistency Index (CI) dan Consistency Ratio (CR)
        $CI = ($lambdaMax - $n) / ($n - 1);
        $RI = $this->getRandomIndex($n);
        $CR = ($RI == 0) ? 0 : $CI / $RI;

        // Simpan ke ahp_results
        $this->ahpResultModel->insert([
            'period_id'    => $activePeriodId,
            'weights'      => json_encode($weights),
            'calculated_by' => session()->get('user_id') ?? 1,
            'is_valid'     => $CR < 0.1, // valid jika CR < 0.1
            'consistency_ratio' => $CR,
            'created_at'   => date('Y-m-d H:i:s')
        ]);

        $this->generateEvaluationResults();

        return view('performance-assesment/v_index.php');
    }
}
