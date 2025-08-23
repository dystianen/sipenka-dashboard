<?php

namespace App\Models;

use CodeIgniter\Model;

class AHPNormalizationModel extends Model
{
    protected $table            = 'ahp_normalizations';
    protected $primaryKey       = 'ahp_normalization_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'ahp_result_id',
        'criteria_id_row',
        'criteria_id_col',
        'normalized_value',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
