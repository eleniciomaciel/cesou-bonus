<?php

namespace App\Controllers\Levatraz;

use App\Controllers\BaseController;
use App\Models\LevaTrazModel;

class LevraTrazController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "leva_traz_panel") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        $model = model(LevaTrazModel::class);
        $data = ['clientes' => $model->getClientes()];
        return view('LevaTraz/Home', $data);
    }
    public function dadoClienteLevaTraz()
    {
        if($this->request->getVar('id'))
        {
            $model = model(LevaTrazModel::class);
            $data = $model->getClientes($this->request->getVar('id'));
            echo json_encode($data);
        }
    }
    public function atualizaClienteLevaTraz() {
        $model = model(LevaTrazModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'status_cliente'=>[
                 'rules'=>'required',
                 'errors'=>[
                     'required'=>'Usuário é obrigatório.',
                 ]
             ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $id = $this->request->getPost('hidden_cliente_id');
             $data = [
                 'lvt_status'       =>  $this->request->getPost('status_cliente'),
             ];
             $query = $model->update($id, $data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Cadastro atualizado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Existem alguns erros, verifique por favor']);
             }
        }
    }
}
