<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BradescoModel;
use \Hermawan\DataTables\DataTable;


class BradescoController extends BaseController
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
        $model_bradesco = model(BradescoModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'agenda_nome'=>[
                 'rules'=>'required',
                 'errors'=>[
                     'required'=>'Usuário não reconhecido.',
                 ]
             ],
             'agenda_data'=>[
                  'rules'=>'required|valid_date',
                  'errors'=>[
                      'required'=>'Escolha uma data',
                      'valid_date'=>'Data fora do padrão',
                  ]
            ],
            'agenda_hora'=>[
                'rules'=>'required|validaHoras[agenda_data, agenda_hora, agenda_minut]',
                'errors'=>[
                    'required'=>'Escolha a hora.',
                    'validaHoras'=>'Ops! Já existe uma agenda para essa data e horário.',
            ]
                ],
                'agenda_minut'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Escolha os minutos.'
                    ]
            ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $time = $this->request->getPost('agenda_hora').':'.$this->request->getPost('agenda_minut').':00';
             $data_tempo = $this->request->getPost('agenda_data').' '.$time;
             $data = [
                 'brad_cliente_id'  =>  $this->request->getPost('id_usuario'),
                 'brad_date'        =>  $this->request->getPost('agenda_data'),
                 'brad_time'        =>  $time,
                 'brad_date_time'   =>  $data_tempo,
             ];
             $query = $model_bradesco->insert($data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Agendamento realizado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Existem alguns erros, verifique por favor']);
             }
        }
    }

    public function getListaBradescoAtendimento()
    {
        $db = model(BradescoModel::class);
                $id = session()->get('id');
        $builder = $db->select('brad_date, brad_time, status, brad_id')
        ->where('status', 'Aguardando')
        ->where('brad_cliente_id', $id);
    
        return DataTable::of($builder)
        ->add('action', function($row){
            return '
            <button type="button" class="cancela_agenda btn bg-gradient-info" id="'.$row->brad_id.'">Cancelar</button>
            ';
        })->format('brad_date', function($value){
            return date('d/m/Y', strtotime($value));
        })->format('brad_time', function($value){
            return date('H:i', strtotime($value));
        })->format('status', function($value){
            return '<span class="badge badge-sm bg-gradient-warning">'.$value.'</span>';
        })
        ->toJson(true);
    }

    public function cancelamentoAtendimento()
    {
        $model = model(BradescoModel::class);
        if($this->request->getVar('id_cancela'))
        {
            $id = $this->request->getVar('id_cancela');
            $data = [
                'status' =>  'Cancelado',
            ];
            $model->where('brad_id', $id)->update($id, $data);
            echo 'Cancelamento realizada com sucesso!';
        }
    }

    public function listaAtendidosCancelados()
    {
        $db = model(BradescoModel::class);
        $id = session()->get('id');
        $builder = $db->select('brad_date, brad_time, status')
        ->where('status !=', 'Aguardando')
        ->where('brad_cliente_id', $id);
        
        return DataTable::of($builder)->format('brad_date', function($value){
            return date('d/m/Y', strtotime($value));
        })->format('brad_time', function($value){
            return date('H:i', strtotime($value));
        })->format('status', function($value){
            return $value == 'Cancelado' ? '<span class="badge badge-sm bg-gradient-danger">'.$value.'</span>':'<span class="badge badge-sm bg-gradient-success">'.$value.'</span>';
        })->toJson(true);
    }

}
