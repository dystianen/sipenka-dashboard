<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PeriodModel;

class PeriodController extends BaseController
{
    protected $periodModel;

    public function __construct()
    {
        $this->periodModel = new PeriodModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;

        $periods = $this->periodModel
            ->orderBy('created_at', 'DESC')
            ->findAll($totalLimit, $offset);

        $totalRows = $this->periodModel->countAllResults();

        $data = [
            'periods' => $periods,
            'pager' => [
                'totalPages' => ceil($totalRows / $totalLimit),
                'currentPage' => $currentPage,
                'limit' => $totalLimit,
            ],
        ];

        return view('periods/v_index', $data);
    }

    public function form()
    {
        helper(['form']);
        $id = $this->request->getVar('id');
        $data = [];

        if ($id) {
            $period = $this->periodModel->find($id);
            if (!$period) {
                return redirect()->to('/periods')->with('failed', 'Criteria not found');
            }

            $data['period'] = $period;
        }

        return view('periods/v_form', $data);
    }


    public function save()
    {
        $this->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $id = $this->request->getPost('period_id');

        $data = [
            'name' => $this->request->getPost('name'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        if ($id) {
            // Edit
            $exists = $this->periodModel->find($id);
            if (!$exists) {
                return redirect()->to('/periods')->with('failed', 'Period not found');
            }

            $this->periodModel->update($id, $data);
            return redirect()->to('/periods')->with('success', 'Period updated successfully');
        } else {
            // Create
            $this->periodModel->insert($data);
            return redirect()->to('/periods')->with('success', 'Period added successfully');
        }
    }


    public function delete($id)
    {
        $this->periodModel->delete($id);
        return redirect()->to('/periods')->with('success', 'Period deleted successfully');
    }
}
