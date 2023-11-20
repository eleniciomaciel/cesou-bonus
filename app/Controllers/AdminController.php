<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DescontolojaModel;
use \Hermawan\DataTables\DataTable;

class AdminController extends BaseController
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
        $model = model(DescontolojaModel::class);
        $data['VendasMes'] = $model->findAll();
        return view("Admin/home-admin", $data);
    }

    public function clientes()
    {
        return view('Admin/partial/pages/page-clientes');
    }

    public function cadastrosClientes()
    {
        $register_login = model(RegistroUsuarioModel::class);
        $validation = \Config\Services::validation();
        
        $this->validate([
             'cli_nome'=>[
                 'rules'=>'required|is_unique[acesso_login.reg_nome]|max_length[100]|min_length[10]',
                 'errors'=>[
                     'required'=>'Nome completo deve ser preenchido',
                     'max_length'=>'Você ultrapassou de caracteres.',
                     'min_length'=>'O nome está muito curto.',
                     'is_unique'=>'O nome já existe.',
                 ]
             ],
             'cli_tel'=>[
                'rules'=>'required|is_unique[acesso_login.reg_telefone]|exact_length[15]',
                'errors'=>[
                    'required'=>'informe um telefone',
                    'is_unique'=>'Esse telefone já existe.',
                    'exact_length'=>'O telefone deve conter 14 caracteres.',
                ]
            ],
            'cli_cpf'=>[
                'rules'=>'required|is_unique[acesso_login.reg_cpf]',
                'errors'=>[
                    'required'=>'informe um cpf',
                    'is_unique'=>'O cpf já existe.',
                ]
            ],
             'cli_cep'=>[
                  'rules'=>'required|exact_length[10]',
                  'errors'=>[
                      'required'=>'informe um cep',
                      'exact_length'=>'informe um cep'
                  ]
            ],
            'cli_uf'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe a UF'
                ]
          ],
            'cli_cidade'=>[
                'rules'=>'required|max_length[50]',
                'errors'=>[
                    'required'=>'informe uma cidade',
                    'max_length'=>'A cidade deve ter até 50 caracteres.',
                ]
            ],
            'cli_bairro'=>[
                'rules'=>'required|max_length[50]',
                'errors'=>[
                    'required'=>'informe um bairro.',
                    'max_length'=>'O bairro deve ter até 50 caracteres.',
                ]
            ],
            'cli_endereco'=>[
                'rules'=>'required|max_length[100]',
                'errors'=>[
                    'required'=>'informe um endereço',
                    'max_length'=>'O endereço deve ter até 100 caracteres.',
                ]
            ],
            'cli_email'=>[
                'rules'=>'required|valid_email|is_unique[acesso_login.reg_email]',
                'errors'=>[
                    'required'=>'informe um cpf',
                    'is_unique'=>'O email informado já existe.',
                    'valid_email'=>'Informe um email válido.',
                ]
            ],
            'cli_senha'=>[
                'rules'=>'required|regex_match[/^[a-zA-Z]\w{5,10}$/]',
                'errors'=>[
                    'required'=>'informe uma senha.',
                    'regex_match'=>'O primeiro caractere da senha deve ser uma letra, deve conter no mínimo 5 caracteres e no máximo 10 caracteres e nenhum outro caractere além de letras, números e sublinhado pode ser usado.',
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $data = [
                 'reg_nome'         =>  strtoupper($this->request->getPost('cli_nome')),
                 'reg_telefone'     =>  $this->request->getPost('cli_tel'),
                 'reg_cpf'          =>  $this->request->getPost('cli_cpf'),
                 'reg_cep'          =>  $this->request->getPost('cli_cep'),
                 'reg_uf'           =>  strtoupper($this->request->getPost('cli_uf')),
                 'reg_cidade'       =>  strtoupper($this->request->getPost('cli_cidade')),
                 'reg_bairro'       =>  strtoupper($this->request->getPost('cli_bairro')),
                 'reg_endereco'     =>  strtoupper($this->request->getPost('cli_endereco')),
                 'reg_email'        =>  strtolower($this->request->getPost('cli_email')),
                 'reg_senha'        =>  password_hash($this->request->getPost('cli_senha'), PASSWORD_DEFAULT),
                 'role'             =>  'gestor',
             ];

             $query = $register_login->insert($data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Registro cadastrado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Algo deu errado']);
             }
        }
    }

    public function listLojasGestor()
    {
        $db = model(RegistroUsuarioModel::class);
        $builder = $db->select('id, reg_nome, reg_telefone, reg_uf, reg_cidade, reg_email, status, role')
        ->where('role', 'gestor');

        return DataTable::of($builder)
        ->add('action', function ($row) {
            return '
            
            <div class="dropdown">
                <button class="btn bg-gradient-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    OPÇÕES
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="javascript:;">VISUALIZAR</a></li>
                    <li><a class="dropdown-item" href="javascript:;">STATUS</a></li>
                    <li><a class="dropdown-item" href="javascript:;">DELETAR</a></li>
                </ul>
            </div>

            ';
        })
        ->toJson(true);
    }
}
