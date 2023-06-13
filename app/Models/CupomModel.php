<?php

namespace App\Models;

use CodeIgniter\Model;

class CupomModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'cupom';
    protected $primaryKey       = 'cup_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'cup_qrcode_cupom',
        'cup_key_cupom',
        'cup_data_cupom',
        'cup_valor_cupom',
        'cup_cnpj_cupom',
        'cup_empresa_vendedora_cupom',
        'cup_data_vencimento_cupom',
        'cup_status',
        'cup_usuario_id',
        'cup_loja_do_desconto_id',
        'cup_pontos',
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
