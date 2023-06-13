<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LojaModel;
use App\Models\RegistroUsuarioModel;
use \Hermawan\DataTables\DataTable;

class LojasAdmimController extends BaseController
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
        return view('Admin/partial/pages/page-lojas');
    }

    public function getUsuarios()
    {
        if ($this->request->isAJAX()) {
            $builder_user = model(RegistroUsuarioModel::class);
            $dados = $builder_user->get();
            return json_encode($dados);
        }
    }

    /**
     * inserir novos logistas
     */
    public function adicionaLojistas()
    {
        $register_login = model(LojaModel::class);
        $validation = \Config\Services::validation();
        
        $this->validate([
             'loja_usuario'=>[
                 'rules'=>'required|is_unique[lojas.loja_usuario_id]',
                 'errors'=>[
                     'required'=>'Escolha um usuário.',
                     'is_unique'=>'O nome já existe.',
                 ]
             ],
             'emp_nome_empresarial'=>[
                'rules'=>'required|is_unique[lojas.loja_nome_empresarial]',
                'errors'=>[
                    'required'=>'Nome da loja é origatório.',
                    'is_unique'=>'O nome já existe.',
                ]
            ],
             'emp_telefone'=>[
                'rules'=>'required|is_unique[lojas.loja_telefone]|exact_length[15]',
                'errors'=>[
                    'required'=>'informe um telefone',
                    'is_unique'=>'Esse telefone já existe.',
                    'exact_length'=>'O telefone deve conter 14 caracteres.',
                ]
            ],
            'emp_cnpj'=>[
                'rules'=>'required|is_unique[lojas.loja_cnpj]',
                'errors'=>[
                    'required'=>'informe um cnpj',
                    'is_unique'=>'O cnpj já existe.',
                ]
            ],
             'emp_percentual'=>[
                  'rules'=>'required|decimal',
                  'errors'=>[
                      'required'=>'informe um valor.',
                      'decimal'=>'Informe um valor decimal.',
                  ]
            ],
            'emp_email'=>[
                'rules'=>'required|max_length[100]|valid_email|is_unique[lojas.loja_email]',
                'errors'=>[
                    'required'=>'informe um email.',
                    'max_length'=>'email muito longo.',
                    'valid_email'=>'informe um email válido.',
                    'is_unique'=>'email já existe.',
                ]
          ],
            'emp_nome_fantasia'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'nome fantasia é obrigatório'
                ]
          ],
            'emp_data_abertura'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe uma data',
                ]
            ],
            'emp_cep'=>[
                'rules'=>'required|max_length[10]',
                'errors'=>[
                    'required'=>'informe um cep.',
                    'max_length'=>'O cep deve ter até 10 caracteres.',
                ]
            ],
            'emp_uf'=>[
                'rules'=>'required|max_length[2]',
                'errors'=>[
                    'required'=>'informe um uf',
                    'max_length'=>'A uf deve ter até 100 caracteres.',
                ]
            ],
            'emp_ciade'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe um cidade',
                ]
            ],
            'emp_bairro'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe um bairro.',
                ]
            ],
            'emp_endereco'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe um endereço.',
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $data = [
                 'loja_usuario_id'          =>  $this->request->getPost('loja_usuario'),
                 'loja_cnpj'                =>  $this->request->getPost('emp_cnpj'),
                 'loja_nome_empresarial'    =>  $this->request->getPost('emp_nome_empresarial'),
                 'loja_email'               =>  $this->request->getPost('emp_email'),
                 'loja_area_tel'            =>  $this->request->getPost('emp_telefone_area'),
                 'loja_telefone'            =>  $this->request->getPost('emp_telefone'),
                 'loja_nome_fantasia'       =>  $this->request->getPost('emp_nome_fantasia'),
                 'loja_data_abertura'       =>  $this->request->getPost('emp_data_abertura'),
                 'loja_cep'                 =>  $this->request->getPost('emp_cep'),
                 'loja_uf'                  =>  $this->request->getPost('emp_uf'),
                 'loja_cidade'              =>  $this->request->getPost('emp_ciade'),
                 'loja_bairro'              =>  $this->request->getPost('emp_bairro'),
                 'loja_endereco'            =>  $this->request->getPost('emp_endereco'),
                 'lojas_percentual'         =>  $this->request->getPost('emp_percentual'),
             ];

             $query = $register_login->insert($data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Registro cadastrado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Algo deu errado']);
             }
        }
    }

    /**
     * lista lojas
     */
    public function getLojistas()
    {
        $db = model(LojaModel::class);
        $builder = $db->select('loja_id, reg_nome, loja_cnpj, loja_nome_empresarial, loja_telefone, loja_status_pontos, loja_cidade')
                       ->join('acesso_login', 'acesso_login.id = lojas.loja_usuario_id');
    
        return DataTable::of($builder)
        ->add('action', function($row){
            return '
            <div class="btn-group dropup mt-7">
                <button type="button" class="btn bg-gradient-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Opções
                </button>
                <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                    <li><a class="view_loja_dados dropdown-item border-radius-md" href="javascript:;" data-id="'.$row->loja_id.'">Visualizar</a></li>
                    <li><a class="delete_loja_dados dropdown-item border-radius-md" href="javascript:;" data-id="'.$row->loja_id.'">Deletar</a></li>
                </ul>
            </div>
            ';
        })
        ->toJson(true);
    }


    public function getDadosLoja()
    {
        if($this->request->getVar('id'))
        {
            $model = model(LojaModel::class);
            $loja_data = $model->where('loja_id', $this->request->getVar('id'))->first();
            echo json_encode($loja_data);
        }
    }
    public function deleteEmpresa()
    {
        if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $model = model(LojaModel::class);
            $model->where('loja_id', $id)->delete($id);
            echo 'Loja deletada com sucesso!';
        }
    }

    public function upLogista()
    {

        $register_loja = model(LojaModel::class);
        $validation = \Config\Services::validation();
        
        $this->validate([
             'up_loja_usuario_id'=>[
                 'rules'=>'required',
                 'errors'=>[
                     'required'=>'Escolha um usuário.',
                 ]
             ],
             'up_loja_nome_empresarial'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Nome da loja é origatório.',
                ]
            ],
             'up_loja_telefone'=>[
                'rules'=>'required|exact_length[11]',
                'errors'=>[
                    'required'=>'informe um telefone',
                    'exact_length'=>'O telefone deve conter 11 caracteres.',
                ]
            ],
            'up_loja_cnpj'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe um cnpj',
                ]
            ],
             'up_lojas_percentual'=>[
                  'rules'=>'required|decimal',
                  'errors'=>[
                      'required'=>'informe um valor.',
                      'decimal'=>'Informe um valor decimal.',
                  ]
            ],
            'up_loja_email'=>[
                'rules'=>'required|max_length[100]|valid_email',
                'errors'=>[
                    'required'=>'informe um email.',
                    'max_length'=>'email muito longo.',
                    'valid_email'=>'informe um email válido.',
                ]
          ],
            'up_loja_nome_fantasia'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'nome fantasia é obrigatório'
                ]
          ],
            'up_loja_data_abertura'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe uma data',
                ]
            ],
            'up_loja_cep'=>[
                'rules'=>'required|max_length[10]',
                'errors'=>[
                    'required'=>'informe um cep.',
                    'max_length'=>'O cep deve ter até 10 caracteres.',
                ]
            ],
            'up_loja_uf'=>[
                'rules'=>'required|max_length[2]',
                'errors'=>[
                    'required'=>'informe um uf',
                    'max_length'=>'A uf deve ter até 100 caracteres.',
                ]
            ],
            'up_loja_cidade'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe um cidade',
                ]
            ],
            'up_loja_bairro'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe um bairro.',
                ]
            ],
            'up_loja_endereco'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe um endereço.',
                ]
            ],
            'up_loja_promocional'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe a descrição promocional.',
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $id = $this->request->getPost('hidden_id_loja');
             $data = [
                 'loja_usuario_id'          =>  $this->request->getPost('up_loja_usuario_id'),
                 'loja_cnpj'                =>  $this->request->getPost('up_loja_cnpj'),
                 'loja_nome_empresarial'    =>  $this->request->getPost('up_loja_nome_empresarial'),
                 'loja_email'               =>  $this->request->getPost('up_loja_email'),
                 'loja_area_tel'            =>  $this->request->getPost('up_loja_area_tel'),
                 'loja_telefone'            =>  $this->request->getPost('up_loja_telefone'),
                 'loja_nome_fantasia'       =>  $this->request->getPost('up_loja_nome_fantasia'),
                 'loja_data_abertura'       =>  $this->request->getPost('up_loja_data_abertura'),
                 'loja_cep'                 =>  $this->request->getPost('up_loja_cep'),
                 'loja_uf'                  =>  $this->request->getPost('up_loja_uf'),
                 'loja_cidade'              =>  $this->request->getPost('up_loja_cidade'),
                 'loja_bairro'              =>  $this->request->getPost('up_loja_bairro'),
                 'loja_endereco'            =>  $this->request->getPost('up_loja_endereco'),
                 'lojas_percentual'         =>  $this->request->getPost('up_lojas_percentual'),
                 'lojas_promocional'        =>  $this->request->getPost('up_loja_promocional'),
             ];

             $query = $register_loja->update($id, $data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Registro alterado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Algo deu errado']);
             }
        }
    }
}
