<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CriteriaModel;

class CriteriaController extends BaseController
{
    protected $criteriaModel;

    public function __construct()
    {
        $this->criteriaModel = new CriteriaModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;

        $criterias = $this->criteriaModel->findAll($totalLimit, $offset);

        $totalRows = $this->criteriaModel->countAllResults();

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
            $teacher = $this->criteriaModel
                ->find($id);

            if (!$teacher) {
                return redirect()->to('/criteria')->with('failed', 'Criteria not found');
            }

            $data['criteria'] = $teacher;
        }

        return view('criteria/v_form', $data);
    }

    public function save()
    {
        $id = $this->request->getVar('id');

        $rules = [
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'weight' => 'required',
            'description' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('failed', 'Please check your input.');
        };

        $data = [
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'weight' => $this->request->getPost('weight'),
            'description' => $this->request->getPost('description'),
        ];

        if ($id) {
            $this->criteriaModel->update($id, $data);
            $message = 'Criteria updated successfully!';
        } else {
            $this->criteriaModel->insert($data);
            $message = 'Criteria created successfully!';
        }

        return redirect()->to('/criteria')->with('success', $message);
    }

    public function delete($id)
    {
        $this->criteriaModel->delete($id);
        return redirect()->to('/criteria')->with('success', 'Data kriteria berhasil dihapus.');
    }
}
