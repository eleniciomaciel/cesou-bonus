<?php

namespace App\Models;

use CodeIgniter\Model;

class BradescoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bradescoexpresses';
    protected $primaryKey       = 'brad_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'brad_cliente_id',
        'brad_date',
        'brad_time',
        'brad_date_time',
        'brad_date_time_atendimento',
        'status',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


}
