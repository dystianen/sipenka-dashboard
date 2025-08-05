<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table            = 'teachers';
    protected $primaryKey       = 'teacher_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'education', 'major', 'institution', 'gender', 'birth_place', 'birth_date', 'address', 'phone_number', 'photo', 'status', 'created_at', 'updated_at', 'deleted_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllWithUser($limit, $offset)
    {
        return $this->select('teachers.teacher_id, teachers.education, teachers.major, teachers.institution, teachers.gender, teachers.phone_number, users.name AS name, users.email')
            ->join('users', 'users.user_id = teachers.user_id')
            ->limit($limit, $offset)
            ->findAll();
    }

    // public function getAllWithScoreStatus($limit, $offset, $periodId, $totalCategories)
    // {
    //     $teachers = $this->getAllWithUser($limit, $offset);
    //     $scoreModel = new \App\Models\TeacherQuestionScoreModel();

    //     foreach ($teachers as &$teacher) {
    //         $scoredCategories = $scoreModel
    //             ->select('DISTINCT(q.category_id)')
    //             ->join('questions q', 'q.question_id = teacher_question_scores.question_id')
    //             ->where('teacher_question_scores.teacher_id', $teacher['teacher_id'])
    //             ->where('teacher_question_scores.period_id', $periodId)
    //             ->countAllResults(false);

    //         $teacher['is_fully_scored'] = $scoredCategories == $totalCategories;
    //     }

    //     return $teachers;
    // }
}
