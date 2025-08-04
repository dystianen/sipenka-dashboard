<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriteriaModel;
use App\Models\QuestionModel;
use App\Models\QuestionSubcategoryModel;

class CriteriaController extends BaseController
{
    protected $questionCategoryModel, $questionSubcategoryModel, $questionModel;

    public function __construct()
    {
        $this->questionCategoryModel = new CriteriaModel();
        $this->questionSubcategoryModel = new QuestionSubcategoryModel();
        $this->questionModel = new QuestionModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;

        $criterias = $this->questionCategoryModel->findAll($totalLimit, $offset);

        $totalRows = $this->questionCategoryModel->countAllResults();

        $data = [
            'criterias' => $criterias,
            'pager' => [
                'totalPages' => ceil($totalRows / $totalLimit),
                'currentPage' => $currentPage,
                'limit' => $totalLimit,
            ],
        ];

        return view('criteria/v_index', $data);
    }

    public function form()
    {
        helper(['form']);
        $id = $this->request->getVar('id');
        $data = [];

        if ($id) {
            $teacher = $this->questionCategoryModel
                ->find($id);

            if (!$teacher) {
                return redirect()->to('/criteria')->with('failed', 'Criteria not found');
            }

            $data['criteria'] = $teacher;
        }

        return view('criteria/v_form', $data);
    }

    public function saveAll()
    {
        $categories = $this->request->getPost('categories');

        if (!$categories || !is_array($categories)) {
            return redirect()->back()->withInput()->with('failed', 'No data submitted.');
        }

        foreach ($categories as $category) {
            // 1. Simpan category
            $categoryData = [
                'name' => $category['name'],
                'description' => $category['description'] ?? null,
            ];

            $categoryId = $this->questionCategoryModel->insert($categoryData, true); // true = return inserted ID

            // 2. Cek dan simpan subcategories jika ada
            if (isset($category['subcategories']) && is_array($category['subcategories'])) {
                foreach ($category['subcategories'] as $subcategory) {
                    $subData = [
                        'category_id' => $categoryId,
                        'name' => $subcategory['name'],
                        'description' => $subcategory['description'] ?? null,
                    ];

                    $subcategoryId = $this->questionSubcategoryModel->insert($subData, true);

                    // 3. Simpan questions jika ada
                    if (isset($subcategory['questions']) && is_array($subcategory['questions'])) {
                        foreach ($subcategory['questions'] as $question) {
                            $questionData = [
                                'category_id' => $categoryId,
                                'subcategory_id' => $subcategoryId,
                                'question_text' => $question['text'],
                                'scoring_type' => 'scale_1_5', // default, bisa disesuaikan
                                'weight' => 1.0, // default, bisa diatur jika ditambahkan ke form
                            ];

                            $this->questionModel->insert($questionData);
                        }
                    }
                }
            }
        }

        return redirect()->to('/questions')->with('success', 'All questions saved successfully!');
    }

    public function delete($id)
    {
        $this->questionCategoryModel->delete($id);
        return redirect()->to('/criteria')->with('success', 'Data kriteria berhasil dihapus.');
    }
}
