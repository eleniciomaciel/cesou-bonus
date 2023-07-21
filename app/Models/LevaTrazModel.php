<?php

namespace App\Models;

use CodeIgniter\Model;

class LevaTrazModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'leva_e_traz';
    protected $primaryKey       = 'lvt_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'lvt_cliente_id',
        'lvt_solicitante', 
        'lvt_tel_whats_app', 
        'lvt_date', 
        'lvt_time', 
        'lvt_tel_dois', 
        'lvt_date_time', 
        'lvt_bairro',
        'lvt_rua', 
        'lvt_description', 
        'lvt_status', 
        'lvt_colaborador_id'
    ];

    // Dates
    protected $useTimestamps = false;
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

    public function getClientes($slug = false)
    {
        if ($slug === false) {
            $data_hoje = date('Y-m-d');
            return $this->where('lvt_date',$data_hoje)->findAll();
        }
        return $this->where(['lvt_id' => $slug])->first();
    }
}
