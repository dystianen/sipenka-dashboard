<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriteriaModel;
use App\Models\QuestionSubcategoryModel;

class SubcategoryController extends BaseController
{
    protected $categoryModel, $subcategoryModel;

    public function __construct()
    {
        $this->categoryModel = new CriteriaModel();
        $this->subcategoryModel = new QuestionSubcategoryModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page') ?? 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;

        $subcategories = $this->subcategoryModel
            ->select('question_subcategories.*, question_categories.name AS category_name')
            ->join('question_categories', 'question_categories.category_id = question_subcategories.category_id')
            ->where('question_subcategories.deleted_at', null)
            ->orderBy('question_subcategories.subcategory_id', 'ASC')
            ->findAll($totalLimit, $offset);

        $totalRows = $this->subcategoryModel
            ->where('deleted_at', null)
            ->countAllResults();

        $data = [
            'subcategories' => $subcategories,
            'pager' => [
                'totalPages' => ceil($totalRows / $totalLimit),
                'currentPage' => $currentPage,
                'limit' => $totalLimit,
            ],
        ];

        return view('question-subcategories/v_index', $data);
    }

    public function getByCategory($categoryId)
    {
        $subcategories = $this->subcategoryModel
            ->where('category_id', $categoryId)
            ->findAll();

        return $this->response->setJSON($subcategories);
    }

    public function form()
    {
        helper(['form']);
        $id = $this->request->getVar('id');

        $categories = $this->categoryModel->findAll();

        if ($id) {
            $subcategory = $this->subcategoryModel->find($id);
            if (!$subcategory) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException("Subcategory not found");
            }
            return view('question-subcategories/v_form', [
                'subcategory' => $subcategory,
                'categories' => $categories
            ]);
        }

        return view('question-subcategories/v_form', [
            'categories' => $categories
        ]);
    }

    public function save()
    {
        $this->validate([
            'category_id' => 'required',
            'name' => 'required|min_length[3]',
            'description' => 'permit_empty|max_length[255]',
        ]);

        $id = $this->request->getPost('subcategory_id');

        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        if ($id) {
            // Edit
            $exists = $this->subcategoryModel->find($id);
            if (!$exists) {
                return redirect()->to('/question-subcategories')->with('failed', 'Category not found');
            }

            $this->subcategoryModel->update($id, $data);
            return redirect()->to('/question-subcategories')->with('success', 'Category updated successfully');
        } else {
            // Create
            $this->subcategoryModel->insert($data);
            return redirect()->to('/question-subcategories')->with('success', 'Category added successfully');
        }
    }

    public function delete($id)
    {
        $this->subcategoryModel->delete($id);
        return redirect()->to('/question-subcategories')->with('message', 'Subcategory deleted successfully.');
    }
}
