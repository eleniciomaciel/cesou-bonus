<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BradescoModel;
use \Hermawan\DataTables\DataTable;

class UsuarioBradescoController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "bradesco_panel") {
            echo 'Access denied';
            exit;
        }
    }

    public function index()
    {
        return view('usuarioBradesco/home-bradesco');
    }
    
    public function atendidosBradesco()
    {
        $db   = model(BradescoModel::class);
        $data = [
            'list_atendidos' => $db->select('reg_nome, brad_date, brad_time, bradescoexpresses.status AS status_atendimento, brad_id, login.status AS status_login')
            //->where('status_atendimento', 'Atendido')
            ->join('acesso_login as login', 'login.id = bradescoexpresses.brad_cliente_id')
            ->findAll()
        ];
        return view('usuarioBradesco/Layout/pages/atendidos-bradesco', $data);
    }

    public function getListaAtendimentosAguardando()
    {
        $data_hoje = date('Y-m-d');
        $db = model(BradescoModel::class);
        $builder = $db->select('reg_nome, brad_date, brad_time, bradescoexpresses.status as novo_status, brad_id')
                      ->where('brad_date >=', $data_hoje)
                      //->where('novo_status !=', 'Aguardando')
                      ->join('acesso_login', 'acesso_login.id = bradescoexpresses.brad_cliente_id');
    
        return DataTable::of($builder)
        ->format('novo_status', function($value){
            return $value == 'Aguardando' ? '<span class="badge badge-sm bg-gradient-success">'.$value.'</span>':'<span class="badge badge-sm bg-gradient-secondary">'.$value.'</span>';
        })
        ->add('action', function($row){
            return '
                <div class="dropdown">
                    <button class="btn bg-gradient-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Opções
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="clsConfirma dropdown-item" href="javascript:;" data-id="'.$row->brad_id.'"><i class="fa fa-check-square-o"></i> Confirmar</a></li>
                        <li><a class="clsCancela dropdown-item" href="javascript:;" data-id="'.$row->brad_id.'"><i class="fa fa-close"></i> Cancelar</a></li>
                        <li><a class="voiceAtendimento dropdown-item" href="javascript:;" data-id="'.$row->brad_id.'" data-username="'.$row->reg_nome.'"><i class="fas fa-microphone"></i> Chamar</a></li>
                    </ul>
                </div>
            ';
        })
        ->toJson(true);
    }

    public function getConfirma()
    {
        if ($this->request->isAJAX() && $this->request->getVar('id')) {
            $id = $this->request->getVar('id');
            $model = model(BradescoModel::class);
            $data = [
                'status' =>  'Atendido',
            ];
            $model->update($id, $data);
            echo 'Atendimento concluído com sucesso!';
        }else {
            exit('Permissão negada');
        }
    }

    public function getCancela()
    {
        if ($this->request->isAJAX() && $this->request->getVar('id')) {
            $id = $this->request->getVar('id');
            $model = model(BradescoModel::class);
            $data = [
                'status' =>  'Cancelado',
            ];
            $model->update($id, $data);
            echo 'Atendimento cancelado com sucesso!';
        }else {
            exit('Permissão negada');
        }
    }

    public function totalHoje()
    {
        $data_hoje = date('Y-m-d');
        $db = \Config\Database::connect();
        $query = $db->query('SELECT count(brad_id) as total_hoje FROM bradescoexpresses WHERE brad_date = "'.$data_hoje.'"');
        $row   = $query->getRow();
        echo $row->total_hoje;
    }

    public function totalHojeAtendidos()
    {
        $data_hoje = date('Y-m-d');
        $db = \Config\Database::connect();
        $query = $db->query('SELECT count(brad_id) as total_hoje FROM bradescoexpresses WHERE brad_date = "'.$data_hoje.'" AND status = "Atendido"');
        $row   = $query->getRow();
        echo $row->total_hoje;
    }

    public function totalHojeAguardando()
    {
        $data_hoje = date('Y-m-d');
        $db = \Config\Database::connect();
        $query = $db->query('SELECT count(brad_id) as total_hoje FROM bradescoexpresses WHERE brad_date = "'.$data_hoje.'" AND status = "Aguardando"');
        $row   = $query->getRow();
        echo $row->total_hoje;
    }

    public function totalGeral()
    {
        $data_hoje = date('Y-m-d');
        $db = \Config\Database::connect();
        $query = $db->query('SELECT count(brad_id) as total_hoje FROM bradescoexpresses');
        $row   = $query->getRow();
        echo $row->total_hoje;
    }
}
