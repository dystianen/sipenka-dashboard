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
            $criteria = $this->questionCategoryModel->find($id);

            if (!$criteria) {
                return redirect()->to('/criteria')->with('failed', 'Criteria not found');
            }

            $data['criteria'] = $criteria;
        }

        return view('criteria/v_form', $data);
    }


    public function save()
    {
        $this->validate([
            'name' => 'required|min_length[3]',
            'description' => 'permit_empty|max_length[255]',
        ]);

        $id = $this->request->getPost('category_id');

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        if ($id) {
            // Edit
            $exists = $this->questionCategoryModel->find($id);
            if (!$exists) {
                return redirect()->to('/criteria')->with('failed', 'Category not found');
            }

            $this->questionCategoryModel->update($id, $data);
            return redirect()->to('/criteria')->with('success', 'Category updated successfully');
        } else {
            // Create
            $this->questionCategoryModel->insert($data);
            return redirect()->to('/criteria')->with('success', 'Category added successfully');
        }
    }


    public function delete($id)
    {
        $this->questionCategoryModel->delete($id);
        return redirect()->to('/criteria')->with('success', 'Category deleted successfully');
    }
}
