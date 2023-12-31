<?php

namespace App\Models;

use CodeIgniter\Model;

class PontosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pontos';
    protected $primaryKey       = 'point_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'point_usuario',
        'point_pontos'
    ];

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

    public function getCliente($id){
        if ($id === false) {
            return $this->findAll();
        }
        return $this->where(['point_usuario' => $id])->first();
    }

    public function getPontos($id){
        if ($id === false) {
            return $this->findAll();
        }
        return $this->join('acesso_login', 'acesso_login.id = pontos.point_usuario')
        ->where(['point_id' => $id])->first();
    }
}
