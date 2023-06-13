<?php

namespace App\Controllers\Cupons;

use App\Controllers\BaseController;
use App\Models\CuponsDoacoeModel;
use \Hermawan\DataTables\DataTable;
use App\Models\RegistroUsuarioModel;

class CuponsDoacoesController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        return view('Admin/partial/pages/page-cupons-doacao');
    }

    public function salvaCupomDoacao()
    {
        
        $model_cupom_doacao = model(CuponsDoacoeModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'url_chave_cupon_doacao'=>[
                 'rules'=>'required|exact_length[146] ',
                 'errors'=>[
                     'required'=>'url chave é obrigatório.',
                     'exact_length'=>'url chave não está no tamanho permitido.',
                 ]
             ],
             'chave_cupon_doacao'=>[
                  'rules'=>'required|exact_length[43]|is_unique[cuponsdoacoes.cd_key_cupom]',
                  'errors'=>[
                      'required'=>'A chave é obrigatório',
                      'exact_length'=>'A chave está for do padrão',
                      'is_unique'=>'Cupom já cadastrado, leia outro por favor.',
                  ]
            ],
            'cnpj_leitor_doacao'=>[
                'rules'=>'required|exact_length[14]|validaCNPJ[cnpj_leitor_doacao]',
                'errors'=>[
                    'required'=>'O cnpj é obrigatório.',
                    'exact_length'=>'O tamanho do cnpj está fora do padrão.',
                    'validaCNPJ'=>'Esse CNPJ não é permitido, utilize o padrão.'
                ]
            ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $data_tempo = $this->request->getPost('agenda_data').':'.$this->request->getPost('agenda_hora');
             $data = [
                 'cd_qrcode_cupom'              =>  $this->request->getPost('url_chave_cupon_doacao'),
                 'cd_key_cupom'                 =>  $this->request->getPost('chave_cupon_doacao'),
                 'cd_data_cupom'                =>  date('Y-m-d'),
                 'cd_valor_cupom'               =>  '0.01',
                 'cd_cnpj_cupom'                =>  $this->request->getPost('cnpj_leitor_doacao'),
                 'cd_empresa_vendedora_cupom'   =>  '1',
                 'cd_data_vencimento_cupom'     =>  date('Y-m-d', strtotime(' +30 day')),
                 'cd_status'                    =>  'Ativo',
                 'cd_pontos'                    =>  1,
                 'cd_doador_id'                =>  session()->get('id'),
             ];
             $query = $model_cupom_doacao->insert($data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Cupom adicionado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Existem alguns erros, verifique por favor']);
             }
        }
    }

    public function listaAbertos()
    {
        if ($this->request->isAJAX()) {
           
            $db = db_connect();
            $builder = $db->table('cuponsdoacoes')
                          ->select('cd_id, cd_key_cupom, cd_data_cupom, cd_data_vencimento_cupom, cd_status, cd_doador_id, cd_usuario_id, user.reg_nome as usuario')
                          ->join('acesso_login AS user', 'user.id = cuponsdoacoes.cd_doador_id')->where('cd_status','Ativo');
        
            return DataTable::of($builder)
            ->add('action', function($row){
                return '
                
                <a href="javascript:;" class="faz_doacao mx-3" title="Fazer doação" id="'.$row->cd_id.'">
                    <i class="fas fa-eye text-secondary" aria-hidden="true"></i>
                </a>

                <a href="javascript:;" class="delete_doacao mx-3" title="Deletar doação" id="'.$row->cd_id.'">
                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                </a>
                
                ';
            })->format('cd_data_cupom', function($value){
                return date('d/m/Y', strtotime($value));
            })->format('cd_data_vencimento_cupom', function($value){
                return date('d/m/Y', strtotime($value));
            })->format('cd_status', function($value){
                return $value == 'Ativo' ? '<span class="badge bg-gradient-danger">Não doado</span>':'<span class="badge bg-gradient-info">'.$value.'</span>';
            })
            ->toJson(true);

        }
    }


    public function listCuponsDoados()
    {
        if ($this->request->isAJAX()) {
           
            $db = db_connect();
            $builder = $db->table('cuponsdoacoes')
                          ->select('cd_id, cd_key_cupom, cd_data_cupom, cd_data_vencimento_cupom, cd_status, cd_doador_id, cd_usuario_id, doador.reg_nome as doado')
                          ->join('acesso_login AS doador', 'doador.id = cuponsdoacoes.cd_usuario_id')->where('cd_status','Compensado');
        
            return DataTable::of($builder)
            ->format('cd_data_cupom', function($value){
                return date('d/m/Y', strtotime($value));
            })->format('cd_data_vencimento_cupom', function($value){
                return date('d/m/Y', strtotime($value));
            })->format('cd_status', function($value){
                return $value == 'Ativo' ? '<span class="badge bg-gradient-danger">Não doado</span>':'<span class="badge bg-gradient-info">'.$value.'</span>';
            })
            ->toJson(true);

        }
    }

    public function listUniqDoacao(){
        if($this->request->getVar('doar_id'))
        {
            $model = model(CuponsDoacoeModel::class);
            $user_data = $model->where('cd_id', $this->request->getVar('doar_id'))->first();
            echo json_encode($user_data);
        }
    }

    public function listaUsuariosRecebeCupom(){
        $model = model(RegistroUsuarioModel::class);
        $user_data = $model->where('role', 'user')->findAll();
        echo json_encode($user_data);
    }

    public function salvarDoacao(){
        $model_cupom_doacao = model(CuponsDoacoeModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'cupom_chave_cupom'=>[
                 'rules'=>'required|exact_length[43] ',
                 'errors'=>[
                     'required'=>'url chave é obrigatório.',
                     'exact_length'=>'url chave não está no tamanho permitido.',
                 ]
             ],
             'cupom_vencimento'=>[
                  'rules'=>'required|valid_date|validaData[cupom_vencimento]',
                  'errors'=>[
                      'required'=>'Escolha uma  data',
                      'valid_date'=>'O campo deve ter uma data válida',
                      'validaData'=>'Esse cupom já está vencido para doação.',
                  ]
            ],
            'cupom_status'=>[
                'rules'=>'required|validaStatus[cupom_status]',
                'errors'=>[
                    'required'=>'Selecione uma opção de estatus.',
                    'validaStatus'=>'Cupom já foi doado para outra pessoa.'
                ]
            ],
            'cliente_cupom'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Escolha um cliente.',
                ]
            ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $id = $this->request->getPost('doar_id');

             $data = [
                 'cd_status'                    =>  $this->request->getPost('cupom_status'),
                 'cd_usuario_id'                =>  $this->request->getPost('cliente_cupom'),
                 'cd_doador_id'                 =>  session()->get('id'),
             ];
             $query = $model_cupom_doacao->update($id, $data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Doação realizada com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Existem alguns erros, verifique por favor']);
             }
        }
    }

    public function deleteCupom(){
        if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $model = model(CuponsDoacoeModel::class);
            $model->where('cd_id', $id)->delete($id);
            echo 'Cupom deletada com sucesso!';
        }
    }
    
}
