<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriteriaModel;
use App\Models\PeriodModel;
use App\Models\QuestionModel;
use App\Models\QuestionSubcategoryModel;
use App\Models\TeacherModel;
use App\Models\TeacherQuestionScoreModel;

class PerformanceController extends BaseController
{
    protected $teacherModel, $criteriaModel, $subcategoryModel, $questionModel, $periodModel;

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
        $this->criteriaModel = new CriteriaModel();
        $this->subcategoryModel = new QuestionSubcategoryModel();
        $this->questionModel = new QuestionModel();
        $this->periodModel = new PeriodModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;

        $teachers = $this->teacherModel->getAllWithUser($totalLimit, $offset);
        $totalRows = $this->teacherModel->countAllResults();

        $data = [
            'teachers' => $teachers,
            'pager' => [
                'totalPages' => ceil($totalRows / $totalLimit),
                'currentPage' => $currentPage,
                'limit' => $totalLimit,
            ],
        ];

        return view('performance-assesment/v_index', $data);
    }

    public function pageCriteria()
    {
        $criterias = $this->criteriaModel->findAll();
        $data = [
            'criterias' => $criterias
        ];

        return view('performance-assesment/v_criteria', $data);
    }

    public function pageEvaluation($teacherId, $criteriaId)
    {
        // Ambil kategori sesuai criteriaId (jika 'criteria_id' adalah field yang valid)
        $categories = $this->criteriaModel
            ->where('category_id', $criteriaId)
            ->findAll();

        foreach ($categories as &$category) {
            // Ambil subkategori dari kategori terkait
            $subcategories = $this->subcategoryModel
                ->where('category_id', $category['category_id'])
                ->findAll();

            foreach ($subcategories as &$subcategory) {
                // Ambil pertanyaan dari subkategori terkait
                $questions = $this->questionModel
                    ->where('subcategory_id', $subcategory['subcategory_id'])
                    ->findAll();

                $subcategory['questions'] = $questions;
            }

            $category['subcategories'] = $subcategories;
        }

        $data = [
            'teacherId' => $teacherId,
            'categories' => $categories
        ];

        return view('performance-assesment/v_evaluation', $data);
    }

    public function save()
    {
        $request = $this->request;

        $teacherId = $request->getPost('teacher_id');
        $scores = $request->getPost('scores');

        $activePeriod = $this->periodModel->where('is_active', 1)->first();
        $periodActiveId = $activePeriod['period_id'];

        $givenBy = session()->get('user_id');

        $scoreModel = new TeacherQuestionScoreModel();

        // dd($scores);

        foreach ($scores as $questionId => $score) {
            $scoreModel->insert([
                'teacher_id' => $teacherId,
                'period_id'  => $periodActiveId,
                'question_id' => $questionId,
                'score'      => $score,
                'given_by'   => $givenBy,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to('/performance-assesment')->with('message', 'Penilaian berhasil disimpan.');
    }
}
