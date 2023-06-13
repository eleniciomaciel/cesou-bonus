<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LevaTrazModel;
use \Hermawan\DataTables\DataTable;

class LevaTrazController extends BaseController
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
        $model_leva_traz = model(LevaTrazModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'lvt_solicitante'=>[
                 'rules'=>'required',
                 'errors'=>[
                     'required'=>'Informe um solicitante.',
                 ]
             ],
             'id_solicitante_lvt'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'Usuário não reconhecido',
                  ]
            ],
            'lvt_tel_um'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Escolha um telefone.'
                ]
            ],
            'data_lvt'=>[
                'rules'=>'required|valid_date',
                'errors'=>[
                    'required'=>'Escolha uma data para.',
                    'valid_date'=>'Escolha uma data válida.',
                ]
            ],
            'hora_lvt'=>[
                'rules'=>'required|validaHoraLevaTraz[data_lvt, hora_lvt]',
                'errors'=>[
                    'required'          =>'Escolha um horário para seu atentimento.',
                    'validaHoraLevaTraz'=>'Esse horário já está agendado por outro clinte, escolha outro.',
                ]
            ],
            'lvt_bairro'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Informe um bairro.'
                ]
            ],
            'lvt_rua'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Informe uma rua.'
                ]
            ],
            'lvt_observacao'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Informe um ponto de referência.'
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $data_tempo = $this->request->getPost('data_lvt').':'.$this->request->getPost('hora_lvt');
             $data = [
                 'lvt_cliente_id'       =>  $this->request->getPost('id_solicitante_lvt'),
                 'lvt_solicitante'      =>  $this->request->getPost('lvt_solicitante'),
                 'lvt_tel_whats_app'    =>  $this->request->getPost('lvt_tel_um'),
                 'lvt_date'             =>  $this->request->getPost('data_lvt'),
                 'lvt_time'             =>  $this->request->getPost('hora_lvt'),
                 'lvt_tel_dois'         =>  $this->request->getPost('lvt_tel_dois'),
                 'lvt_date_time'        =>   $data_tempo,
                 'lvt_bairro'           =>  $this->request->getPost('lvt_bairro'),
                 'lvt_rua'              =>  $this->request->getPost('lvt_rua'),
                 'lvt_description'      =>  $this->request->getPost('lvt_observacao'),
             ];
             $query = $model_leva_traz->insert($data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Solicitação realizado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Existem alguns erros, verifique por favor']);
             }
        }
    }

    public function listCollunmLevaTraz()
    {
        $db = model(LevaTrazModel::class);
        $id = session()->get('id');
        $builder = $db->select('lvt_date, lvt_time, lvt_status, lvt_id')
        ->where('lvt_status', 'Aguardando')->where('lvt_cliente_id', $id);

        return DataTable::of($builder)
        ->add('action', function ($row) {
            return '<button type="button" class="status_leva_traz btn bg-gradient-warning" id="'.$row->lvt_id.'">CANCELAR</button>';
        })->add('status_viw', function ($row) {
            return '<span class="badge badge-sm bg-gradient-primary">'.$row->lvt_status.'</span>';
        })
        ->format('lvt_date', function ($value) {
            return date('d/m/Y', strtotime($value));
        })->format('lvt_time', function($value){
            return date('H:i', strtotime($value));
        })
        ->toJson(true);
    }

        /**
     * cancela leva e traz
     */
    public function cancelarLevaTraz()
    {
        $model = model(LevaTrazModel::class);
        if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $data = [
                'lvt_status' =>  'Cancelado',
            ];
            $model->where('lvt_id', $id)->update($id, $data);
            echo 'Cancelamento realizada com sucesso!';
        }
    }

        /**
     * listagem cancelados
     */
    public function listCollunmLevaTrazCancelados()
    {
        $db = model(LevaTrazModel::class);
        
        $id = session()->get('id');
        $builder = $db->select('lvt_id, lvt_solicitante, lvt_date, lvt_time, lvt_status')
        ->where('lvt_status !=', 'Aguardando')
        ->where('lvt_cliente_id', $id);

        return DataTable::of($builder)
        ->add('status_viw', function ($row) {
            return $row->lvt_status == 'Cancelado' ? '<span class="badge badge-sm bg-gradient-secondary">'.$row->lvt_status.'</span>':'<span class="badge badge-sm bg-gradient-success">'.$row->lvt_status.'</span>';
        })
        ->format('lvt_date', function ($value) {
            return date('d/m/Y', strtotime($value));
        })->format('lvt_time', function($value){
            return date('H:i', strtotime($value));
        })
        ->toJson(true);
    }
}
