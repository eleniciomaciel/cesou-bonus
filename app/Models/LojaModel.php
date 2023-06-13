<?php

namespace App\Models;

use CodeIgniter\Model;

class LojaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'lojas';
    protected $primaryKey       = 'loja_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'loja_usuario_id',
        'loja_cnpj',
        'loja_nome_empresarial',
        'loja_email',
        'loja_area_tel',
        'loja_telefone',
        'loja_nome_fantasia',
        'loja_data_abertura',
        'loja_cep',
        'loja_uf',
        'loja_cidade',
        'loja_bairro',
        'loja_endereco',
        'loja_status_pontos',
        'loja_lojista_id',
        'lojas_percentual',  
        'lojas_promocional',  
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
