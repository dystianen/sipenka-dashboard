<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TeacherModel;
use CodeIgniter\HTTP\ResponseInterface;

class TeacherController extends BaseController
{
    protected $teacherModel;

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
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

        return view('teachers/v_index', $data);
    }

    public function form()
    {
        helper(['form']);
        $id = $this->request->getVar('id');
        $data = [];

        if ($id) {
            $teacher = $this->teacherModel
                ->select('teachers.*, users.name, users.email')
                ->join('users', 'users.user_id = teachers.user_id')
                ->find($id);

            if (!$teacher) {
                return redirect()->to('/teachers')->with('failed', 'Teacher not found');
            }

            $data['teacher'] = $teacher;
        }

        return view('teachers/v_form', $data);
    }


    public function save()
    {
        $request = $this->request;
        $id = $request->getVar('teacher_id');

        $userModel = new \App\Models\UserModel();
        $teacherModel = new \App\Models\TeacherModel();

        $userData = [
            'name'  => $request->getPost('name'),
            'email' => $request->getPost('email'),
            'role'  => 'guru',
        ];

        $password = $request->getPost('password');
        if ($password) {
            $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $teacherData = [
            'nip'           => $request->getPost('nip'),
            'education'     => $request->getPost('education'),
            'major'         => $request->getPost('major'),
            'institution'   => $request->getPost('institution'),
            'gender'        => $request->getPost('gender'),
            'birth_place'   => $request->getPost('birth_place'),
            'birth_date'    => $request->getPost('birth_date'),
            'address'       => $request->getPost('address'),
            'phone_number'  => $request->getPost('phone_number'),
            'status'        => $request->getPost('status'),
        ];

        // --- Handle photo upload ---
        $photo = $request->getFile('photo');
        $photoName = null;

        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $name = $photo->getRandomName();
            $photo->move('uploads/teachers', $name);
            $photoName = '/uploads/teachers/' . $name;
        }


        if ($photoName) {
            $teacherData['photo'] = $photoName;
        }

        if (!$id) {
            // --- Create ---
            $userModel->insert($userData);
            $userId = $userModel->getInsertID();

            $teacherData['user_id'] = $userId;

            $teacherModel->insert($teacherData);

            return redirect()->to('/teachers')->with('success', 'Guru berhasil ditambahkan.');
        } else {
            // --- Update ---
            $teacher = $teacherModel->find($id);
            if (!$teacher) {
                return redirect()->to('/teachers')->with('error', 'Guru tidak ditemukan.');
            }

            // Hapus foto lama jika ada dan upload baru
            if ($photoName && !empty($teacher['photo']) && file_exists('uploads/teachers/' . $teacher['photo'])) {
                unlink('uploads/teachers/' . $teacher['photo']);
            }

            $userModel->update($teacher['user_id'], $userData);
            $teacherModel->update($id, $teacherData);

            return redirect()->to('/teachers')->with('success', 'Data guru berhasil diperbarui.');
        }
    }

    public function delete($id)
    {
        $this->teacherModel->delete($id);
        return redirect()->to('/products')->with('success', 'Data guru berhasil dihapus.');
    }
}
