<?php

namespace App\Models;

use CodeIgniter\Model;

class CuponsDoacoeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'cuponsdoacoes';
    protected $primaryKey       = 'cd_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'cd_qrcode_cupom',
        'cd_key_cupom',
        'cd_data_cupom',
        'cd_valor_cupom',
        'cd_cnpj_cupom',
        'cd_empresa_vendedora_cupom',
        'cd_data_vencimento_cupom',
        'cd_status',
        'cd_pontos',
        'cd_usuario_id',
        'cd_doador_id',
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
}
