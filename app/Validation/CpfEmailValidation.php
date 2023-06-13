<?php

namespace App\Validation;

class CpfEmailValidation
{
    public function validaExisteDados(string $str, string $fields, array $data)
    {
        $model = model(RegistroUsuarioModel::class);
        $array = ['reg_email' => $data['reg_email'], 'reg_cpf' => $data['reg_cpf'], 'status' => 'ativo'];
        $user = $model->where($array)->first();

        if (!$user) {
            return false;
        }else {
            return true;
        }
    }

    public function validaCNPJ(string $str, string $fields, array $data)
    {
        $cnpj_origem = '11114552000147';
        if ($cnpj_origem != $data['cnpj_leitor_doacao']) {
            return false;
        }else {
            return true;
        }
    }

    public function validaData(string $str, string $fields, array $data){
        $data_hoje = date('Ym-d');
        if($data_hoje <= $data['cupom_vencimento']){
            return false;
        }else{
            return true;
        }
    }

    public function validaStatus(string $str, string $fields, array $data){
        
        if($data['cupom_status'] == 'Ativo'){
            return false;
        }else{
            return true;
        }
    }
}
