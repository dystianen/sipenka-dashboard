<?php

namespace App\Models;

use CodeIgniter\Model;

class EvaluationResultModel extends Model
{
    protected $table            = 'evaluation_results';
    protected $primaryKey       = 'evaluation_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['teacher_id', 'ahp_result_id', 'period_id', 'rank', 'final_score', 'created_at', 'updated_at', 'deleted_at'];

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

    public function getEvaluationWithTeachers($periodId, $ahpResultId, $startDate = null, $endDate = null)
    {
        $builder = $this->db->table($this->table)
            ->select('evaluation_results.*, users.name as teacher_name')
            ->join('teachers', 'teachers.teacher_id = evaluation_results.teacher_id')
            ->join('users', 'users.user_id = teachers.user_id')
            ->where('evaluation_results.period_id', $periodId)
            ->where('evaluation_results.ahp_result_id', $ahpResultId)
            ->where('evaluation_results.deleted_at', null);

        if ($startDate && $endDate) {
            $builder->where('evaluation_results.created_at >=', $startDate . ' 00:00:00')
                ->where('evaluation_results.created_at <=', $endDate . ' 23:59:59');
        }

        return $builder->orderBy('evaluation_results.rank', 'ASC')
            ->get()
            ->getResultArray();
    }
}
