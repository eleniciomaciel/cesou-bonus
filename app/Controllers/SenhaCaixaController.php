<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SenhaCaixaModel;

class SenhaCaixaController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "user") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        $model_senha_caixa = model(SenhaCaixaModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'senha_caixa'=>[
                 'rules'=>'required|validaSenhaCaixa[senha_caixa]',
                 'errors'=>[
                     'required'=>'É necessário informar uma senha.',
                     'validaSenhaCaixa'=>'Ops! Senha incorreta.',
                 ]
             ],
             
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $query = $model_senha_caixa->where('senha_caixa', $this->request->getPost('senha_caixa')); 
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Senha confirmada com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Existem alguns erros, verifique por favor']);
             }
        }
    }
}
