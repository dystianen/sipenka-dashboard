<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherQuestionScoreModel extends Model
{
    protected $table            = 'teacher_question_scores';
    protected $primaryKey       = 'score_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['teacher_id', 'period_id', 'question_id', 'score', 'given_by', 'notes', 'created_at', 'updated_at', 'deleted_at'];

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

    public function getScoredCategoryCount($teacherId, $periodId)
    {
        return $this->builder()
            ->select('q.category_id')
            ->join('questions q', 'q.question_id = teacher_question_scores.question_id')
            ->where('teacher_question_scores.teacher_id', $teacherId)
            ->where('teacher_question_scores.period_id', $periodId)
            ->groupBy('q.category_id')
            ->get()
            ->getResultArray();
    }


    public function getCompletedCategories($teacherId, $periodId)
    {
        $builder = $this->db->table('teacher_question_scores tqs');
        $builder->select('q.category_id');
        $builder->join('questions q', 'q.question_id = tqs.question_id');
        $builder->where('tqs.teacher_id', $teacherId);
        $builder->where('tqs.period_id', $periodId);
        $builder->groupBy('q.category_id');
        $builder->having('COUNT(q.question_id) = (
        SELECT COUNT(*) 
        FROM questions qq 
        WHERE qq.category_id = q.category_id
    )');

        $query = $builder->get();
        return array_column($query->getResultArray(), 'category_id');
    }
}
