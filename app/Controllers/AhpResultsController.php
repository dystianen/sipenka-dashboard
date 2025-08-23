<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AHPNormalizationModel;
use App\Models\AhpResultModel;
use App\Models\AHPWeightModel;
use App\Models\CriteriaModel;
use App\Models\EvaluationResultModel;
use App\Models\PairwiseComparisonModel;
use App\Models\PeriodModel;
use App\Models\TeacherModel;
use App\Models\TeacherQuestionScoreModel;

class AhpResultsController extends BaseController
{
    protected $ahpResultModel, $ahpNormalizationModel, $ahpWeightModel, $teacherScoreModel, $evaluationModel, $periodModel, $teacherModel, $categoryModel, $comparisonModel;

    public function __construct()
    {
        $this->ahpResultModel = new AhpResultModel();
        $this->ahpNormalizationModel = new AHPNormalizationModel();
        $this->ahpWeightModel = new AHPWeightModel();
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

    private function getGradeCategory($score, $maxScore)
    {
        $percentage = ($score / $maxScore) * 100;

        if ($percentage >= 90) {
            return 'Amat Baik (AB)';
        } elseif ($percentage >= 80) {
            return 'Baik (B)';
        } elseif ($percentage >= 70) {
            return 'Cukup (C)';
        } else {
            return 'Kurang (K)';
        }
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
            return redirect()->back()->with('error', 'Belum ada hasil AHP untuk periode ini.');
        }

        $weights = json_decode($ahpResult['weights'], true);
        if (!$weights || empty($weights)) {
            return redirect()->back()->with('error', 'Bobot AHP tidak ditemukan atau kosong.');
        }

        $teachers = $this->teacherModel->findAll();
        if (!$teachers) {
            return redirect()->back()->with('error', 'Tidak ada data guru yang ditemukan.');
        }

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
                $avgScore   = floatval($s['avg_score']);
                $weight     = $weights[$categoryId] ?? 0;

                $finalScore += $avgScore * $weight;
            }

            $results[] = [
                'teacher_id'    => $teacherId,
                'final_score'   => $finalScore,
                'category'      => $finalScore,
                'ahp_result_id' => $ahpResult['ahp_result_id'],
                'period_id'     => $periodId
            ];
        }

        // Setelah foreach hitung $results selesai, cari nilai max
        $maxScore = max(array_column($results, 'final_score'));

        foreach ($results as &$r) {
            // Normalisasi ke skala 100
            $normalized = $maxScore > 0 ? ($r['final_score'] / $maxScore) * 100 : 0;
            $r['normalized_score'] = round($normalized, 2);

            // Tentukan kategori
            if ($normalized > 90 && $normalized <= 100) {
                $category = 'Amat Baik (AB)';
            } elseif ($normalized > 80) {
                $category = 'Baik (B)';
            } elseif ($normalized > 70) {
                $category = 'Cukup (C)';
            } else {
                $category = 'Kurang (K)';
            }

            $r['category'] = $category;
        }
        unset($r);


        // Urutkan & beri ranking
        usort($results, fn($a, $b) => $b['final_score'] <=> $a['final_score']);
        $rank = 1;
        foreach ($results as &$r) {
            $r['rank'] = $rank++;
        }
        unset($r);

        // Hapus hasil lama untuk periode ini
        $this->evaluationModel->where('period_id', $periodId)->delete();

        // Simpan hasil baru (batch insert)
        $this->evaluationModel->insertBatch($results);

        return $results;
    }


    public function calculateAHP()
    {
        // Ambil periode aktif
        $period = $this->periodModel
            ->where('is_active', 1)
            ->first();

        if (!$period) {
            throw new \Exception("Tidak ada periode aktif.");
        }

        $activePeriodId = $period['period_id'];

        // 🔹 Cek apakah sudah ada hasil AHP di periode aktif
        $existingResults = $this->ahpResultModel
            ->where('period_id', $activePeriodId)
            ->findAll();

        if ($existingResults) {
            foreach ($existingResults as $row) {
                $resultId = $row['ahp_result_id'];

                // Hapus tabel relasi (child) dulu
                $this->ahpNormalizationModel->where('ahp_result_id', $resultId)->delete();
                $this->ahpWeightModel->where('ahp_result_id', $resultId)->delete();

                // Baru hapus parent
                $this->ahpResultModel->delete($resultId);
            }
        }

        // 🔹 Ambil kategori
        $categories = $this->categoryModel->findAll();
        $categoryIds = array_column($categories, 'category_id');
        $n = count($categoryIds);

        if ($n == 0) {
            throw new \Exception("Kategori tidak ditemukan.");
        }

        // Inisialisasi matriks pairwise
        $matrix = array_fill(0, $n, array_fill(0, $n, 1.0));

        // Mapping kategori ke indeks matriks
        $categoryIndexMap = array_flip($categoryIds);

        // Ambil data pairwise dari DB
        $comparisons = $this->comparisonModel
            ->where('period_id', $activePeriodId)
            ->findAll();

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

        // 🔹 Simpan ke ahp_results (baru)
        $this->ahpResultModel->insert([
            'period_id'          => $activePeriodId,
            'weights'            => json_encode($weights),
            'calculated_by'      => session()->get('user_id') ?? 1,
            'is_valid'           => $CR < 0.1,
            'lambda_max'         => $lambdaMax,
            'ci'                 => $CI,
            'consistency_ratio'  => $CR,
            'created_at'         => date('Y-m-d H:i:s')
        ]);

        $resultId = $this->ahpResultModel->getInsertID();

        // 🔹 Simpan hasil normalisasi matriks
        foreach ($normalized as $i => $row) {
            foreach ($row as $j => $val) {
                $this->ahpNormalizationModel->insert([
                    'ahp_result_id'   => $resultId,
                    'criteria_id_row' => $categoryIds[$i],
                    'criteria_id_col' => $categoryIds[$j],
                    'normalized_value' => $val
                ]);
            }
        }

        // 🔹 Simpan bobot eigen vector
        foreach ($weights as $criteriaId => $val) {
            $this->ahpWeightModel->insert([
                'ahp_result_id' => $resultId,
                'criteria_id'   => $criteriaId,
                'weight'        => $val
            ]);
        }

        // 🔹 Generate hasil evaluasi guru
        $this->generateEvaluationResults();

        return redirect()->to('/ahp')->with('success', 'Perhitungan AHP berhasil diperbarui untuk periode aktif.');
    }



    public function result()
    {
        // Ambil periode aktif
        $activePeriod = $this->periodModel
            ->where('is_active', 1)
            ->first();

        if (!$activePeriod) {
            return redirect()->back()->with('error', 'Tidak ada periode aktif.');
        }

        // Ambil hasil AHP berdasarkan periode aktif
        $result = $this->ahpResultModel
            ->where('period_id', $activePeriod['period_id'])
            ->first();

        if (!$result) {
            return view('ahp/v_result', [
                'categories'       => [],
                'categoryMap'      => [],
                'normalizedMatrix' => [],
                'weights'          => [],
                'result'           => null,
                'activePeriod'     => $activePeriod
            ]);
        }

        // Ambil data kriteria
        $categories = $this->categoryModel->findAll();
        $categoryMap = array_column($categories, 'name', 'category_id');

        // Ambil normalisasi matriks
        $normalizations = $this->ahpNormalizationModel
            ->where('ahp_result_id', $result['ahp_result_id'])
            ->findAll();

        $normalizedMatrix = [];
        foreach ($normalizations as $n) {
            $normalizedMatrix[$n['criteria_id_row']][$n['criteria_id_col']] = $n['normalized_value'];
        }

        // Ambil bobot eigen vector
        $weights = $this->ahpWeightModel
            ->where('ahp_result_id', $result['ahp_result_id'])
            ->findAll();

        $data = [
            'categories'       => $categories,
            'categoryMap'      => $categoryMap,
            'normalizedMatrix' => $normalizedMatrix,
            'weights'          => $weights,
            'result'           => $result,
            'activePeriod'     => $activePeriod
        ];

        return view('ahp/v_result', $data);
    }
}
