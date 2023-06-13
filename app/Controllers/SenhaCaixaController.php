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
             'resultados'=>[
                 'rules'=>'required|is_unique[cupom.cup_qrcode_cupom]',
                 'errors'=>[
                     'required'=>'É necessário ler o qrcode do cupom.',
                     'is_unique'=>'Ops! Esse QR CODE já foi cadastrado.',
                 ]
             ],
             
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $data = [
                 'cup_qrcode_cupom'             =>  $this->request->getPost('resultados')
             ];
             $query = $model_senha_caixa->insert($data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Cupom cadastrado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Existem alguns erros, verifique por favor']);
             }
        }
    }
}
