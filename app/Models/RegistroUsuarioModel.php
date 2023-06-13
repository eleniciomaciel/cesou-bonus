<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistroUsuarioModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'acesso_login';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'reg_nome',
        'reg_telefone',
        'reg_cpf',
        'reg_cep',
        'reg_uf',
        'reg_cidade',
        'reg_bairro',
        'reg_endereco',
        'reg_email',
        'reg_login',
        'reg_senha',
        'status',
        'role',
        'termos_uso',
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
}
