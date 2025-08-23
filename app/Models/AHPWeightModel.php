<?php

namespace App\Models;

use CodeIgniter\Model;

class AHPWeightModel extends Model
{
    protected $table            = 'ahp_weights';
    protected $primaryKey       = 'ahp_weight_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'ahp_result_id',
        'criteria_id',
        'weight',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
