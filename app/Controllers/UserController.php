<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel, $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $totalLimit = 10;
        $offset = ($currentPage - 1) * $totalLimit;

        $users = $this->userModel
            ->orderBy('users.created_at',  'DESC')
            ->findAll($totalLimit, $offset);

        $totalRows = $this->userModel
            ->countAllResults();

        $totalPages = ceil($totalRows / $totalLimit);

        $data = [
            "users" => $users,
            "pager" => [
                "totalPages" => $totalPages,
                "currentPage" => $currentPage,
                "limit" => $totalLimit,
            ],
        ];

        return view('users/v_index', $data);
    }

    public function form()
    {

        $id = $this->request->getVar('id');
        $data = [];
        $data['roles'] = ['admin', 'kepala_sekolah', 'guru'];

        if ($id) {
            $user = $this->userModel->find($id);
            if (!$user) {
                return redirect()->to('/users')->with('failed', 'Transaction not found.');
            }
            $data['user'] = $user;
        }

        return view('users/v_form', $data);
    }

    public function save()
    {
        $id = $this->request->getVar('id');

        $rules = [
            'name'  => 'required',
            'email' => 'required|valid_email',
            'password'   => $id ? 'permit_empty' : 'required',
            'role'    => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('failed', 'Please check your input.');
        }

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role'    => $this->request->getPost('role'),
        ];

        $password = $this->request->getPost('password');
        if ($password) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($id) {
            $this->userModel->update($id, $data);
            $message = 'User updated successfully!';
        } else {
            $this->userModel->insert($data);
            $message = 'User created successfully!';
        }

        return redirect()->to('/users')->with('success', $message);
    }


    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/users')->with('success', 'User deleted successfully.');
    }
}
