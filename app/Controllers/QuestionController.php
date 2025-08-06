<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriteriaModel;
use App\Models\QuestionModel;
use App\Models\QuestionSubcategoryModel;

class QuestionController extends BaseController
{
    protected $categoryModel, $subcategoryModel, $questionModel;

    public function __construct()
    {
        $this->categoryModel = new CriteriaModel();
        $this->subcategoryModel = new QuestionSubcategoryModel();
        $this->questionModel = new QuestionModel();
    }

    public function index()
    {
        // Ambil halaman saat ini dari query string (misal: ?page=2)
        $currentPage = $this->request->getVar('page') ?? 1;
        $totalLimit = 10; // Ubah jika ingin limit berbeda

        // Hitung offset untuk pagination
        $offset = ($currentPage - 1) * $totalLimit;

        // Ambil data subkategori dengan limit & offset
        $questions = $this->questionModel
            ->select([
                'questions.*',
                'question_categories.name AS category_name',
                'question_subcategories.name AS subcategory_name'
            ])
            ->join('question_categories', 'question_categories.category_id = questions.category_id')
            ->join('question_subcategories', 'question_subcategories.subcategory_id = questions.subcategory_id')
            ->where('questions.deleted_at', null)
            ->orderBy('question_id', 'ASC')
            ->findAll($totalLimit, $offset);

        // Hitung total baris (untuk pagination)
        $totalRows = $this->questionModel
            ->where('deleted_at', null)
            ->countAllResults();

        // Kirim data ke view
        $data = [
            'questions' => $questions,
            'pager' => [
                'totalPages' => ceil($totalRows / $totalLimit),
                'currentPage' => $currentPage,
                'limit' => $totalLimit,
            ],
        ];

        return view('questions/v_index', $data);
    }

    public function form()
    {
        helper(['form']);
        $id = $this->request->getVar('id');

        $categories = $this->categoryModel->findAll();
        $subcategories = $this->subcategoryModel->findAll();

        if ($id) {
            $question = $this->questionModel->find($id);
            if (!$question) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException("Subcategory not found");
            }
            return view('questions/v_form', [
                'categories' => $categories,
                'subcategories' => $subcategories,
                'question' => $question,
            ]);
        }

        return view('questions/v_form', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function save()
    {
        $this->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'question_text' => 'required',
            'scoring_type' => 'required',
            'weight' => 'required',
        ]);

        $id = $this->request->getPost('question_id');

        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'subcategory_id' => $this->request->getPost('subcategory_id'),
            'question_text' => $this->request->getPost('question_text'),
            'scoring_type' => $this->request->getPost('scoring_type'),
            'weight' => $this->request->getPost('weight'),
        ];

        if ($id) {
            // Edit
            $exists = $this->questionModel->find($id);
            if (!$exists) {
                return redirect()->to('/questions')->with('failed', 'Question not found');
            }

            $this->questionModel->update($id, $data);
            return redirect()->to('/questions')->with('success', 'Question updated successfully');
        } else {
            // Create
            $this->questionModel->insert($data);
            return redirect()->to('/questions')->with('success', 'Question added successfully');
        }
    }

    public function delete($id)
    {
        $this->questionModel->delete($id);
        return redirect()->to('/questions')->with('message', 'Question deleted successfully.');
    }
}
