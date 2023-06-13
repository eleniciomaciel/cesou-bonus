<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\RegistroUsuario;
use App\Models\RegistroUsuarioModel;
use CodeIgniter\Email\Email as EmailEmail;
use Config\Email;
use \Hermawan\DataTables\DataTable;

class ColaboradoresAdmimController extends BaseController
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
        return view('Admin/partial/pages/page-usuarios');
    }

    public function getUsuariosLojas()
    {
        $model = model(RegistroUsuarioModel::class);
        $data = $model->where('role', 'gestor')->where('status', 'ativo')->findAll();
        echo json_encode($data);
    }

    public function cadastroUsuariosColaboradores()
    {
        return view('Admin/partial/pages/page-colaboradores');
    }

    public function addUserColaboradores()
    {
        $register_login = model(RegistroUsuarioModel::class);
        $validation = \Config\Services::validation();
        
        $this->validate([
             'reg_nome'=>[
                 'rules'=>'required|is_unique[acesso_login.reg_nome]',
                 'errors'=>[
                     'required'=>'Escolha um usuário.',
                     'is_unique'=>'O nome já existe.',
                 ]
             ],
             'reg_login'=>[
                'rules'=>'required|is_unique[acesso_login.reg_login]',
                'errors'=>[
                    'required'=>'O login é origatório.',
                    'is_unique'=>'O login já existe.',
                ]
            ],
             'reg_telefone'=>[
                'rules'=>'required|is_unique[acesso_login.reg_telefone]|exact_length[15]',
                'errors'=>[
                    'required'=>'Informe um telefone.',
                    'is_unique'=>'Esse telefone já existe.',
                    'exact_length'=>'O telefone deve conter 15 caracteres.',
                ]
            ],
            'status'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Informe um status.',
                ]
            ],
             'reg_email'=>[
                  'rules'=>'required|max_length[100]|valid_email|is_unique[acesso_login.reg_email]',
                  'errors'=>[
                      'required'=>'Informe um email.',
                      'max_length'=>'Email muito longo.',
                      'valid_email'=>'Informe um email válido.',
                      'is_unique'=>'O email já existe.',
                  ]
            ],
            'role'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Nível é obrigatório.'
                ]
            ],
            'reg_cpf'=>[
                'rules'=>'required|is_unique[acesso_login.reg_cpf]|exact_length[14]',
                'errors'=>[
                    'required'=>'O cpf é obrigatório.',
                    'is_unique'=>'O cpf já existe.',
                    'exact_length'=>'O cpf deve ter 14 caracteres.',
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

            /**
             * enviando email
             */
            $email = \Config\Services::email();
            $config = [
                    'protocol' =>   'smtp',
                    'SMTPHost' =>   'smtp.mailtrap.io',
                    'SMTPUser' =>   '7707d969e6a8dd',
                    'SMTPPass' =>   '63f9b13f9de2de',
                    'SMTPPort' =>   2525,
                    'wordWrap' =>   true,
                    'mailType' =>   'html',
            ];            
            $email->initialize($config);

            $email->setFrom($this->request->getPost('reg_email'), 'Cestou.Top');
            $email->setTo($this->request->getPost('reg_email'));
            
            $email->setSubject('Olá'.$this->request->getPost('reg_nome').', seu cadastro Cestou.Top foi aprovado.');
            $email->setMessage('
            <!doctype html>
            <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                </head>
            <body style="font-family: sans-serif;">
                <div style="display: block; margin: auto; max-width: 600px;" class="main">
                    <h1 style="font-size: 18px; font-weight: bold; margin-top: 20px">
                        Olá, seu cadastro Cestou.Top foi aprovado.
                    </h1>
                    <p>
                        Click no link <a href="/refatora_login">aqui</a> para ser redirecionado a página de criação de senha.
                    </p>
                    <img alt="Inspect with Tabs" src="https://assets-examples.mailtrap.io/integration-examples/welcome.png" style="width: 100%;">
                    <p>Esse processo é de 00:30 min, após isso deve ser gerado um novo acesso.!</p>
                    <p>Muitom ter você enm nossa equipe!.</p>
                </div>
                <!-- Example of invalid for email html/css, will be detected by Mailtrap: -->
                <style>
                .main { background-color: white; }
                a:hover { border-left-width: 1em; min-height: 2em; }
                </style>
            </body>
            </html>
            ');
            
            $send = $email->send();
            if (!$send) {
                echo json_encode(['code'=>0, 'error'=>$email->printDebugger()]);
            }

             //Insert data into db
             $data = [
                 'reg_nome'          =>  $this->request->getPost('reg_nome'),
                 'reg_telefone'      =>  $this->request->getPost('reg_telefone'),
                 'reg_cpf'           =>  $this->request->getPost('reg_cpf'),
                 'reg_email'         =>  $this->request->getPost('reg_email'),
                 'reg_login'         =>  $this->request->getPost('reg_login'),
                 'status'            =>  $this->request->getPost('status'),
                 'role'              =>  $this->request->getPost('role'),
             ];

             $query = $register_login->insert($data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Usuário cadastrado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Algo deu errado']);
             }
        }
    }

    public function getListaColaboradores()
    {
        if ($this->request->isAJAX()) {
            $db = model(RegistroUsuarioModel::class);
            $builder = $db->select('id, reg_nome, reg_telefone, reg_cpf, reg_email, status, role, created_at');

            return DataTable::of($builder)
                ->add('action', function ($row) {
                    return '<button type="button" class="viewColaborador btn bg-gradient-info" data-id="'.$row->id.'">Visualizar</button>';
                }, 'last')
                ->format('created_at', function($value){
                    return date('d/m/Y', strtotime($value));
                })
                ->toJson(true);
        }else {
            exit('Recurso não encontrado');
        }
    }

    public function getOneColaborador()
    {
        if($this->request->getVar('id') && $this->request->isAJAX())
        {
            $model = model(RegistroUsuarioModel::class);
            $user_data = $model->where('id', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
    }

    public function updateUserColaboradores()
    {
        $register_login = model(RegistroUsuarioModel::class);
        $validation = \Config\Services::validation();
        
        $this->validate([
             'colaborador'=>[
                 'rules'=>'required|is_unique[acesso_login.reg_nome]',
                 'errors'=>[
                     'required'=>'Escolha um usuário.',
                     'is_unique'=>'O nome já existe.',
                 ]
             ],
             'colab_login'=>[
                'rules'=>'required|is_unique[acesso_login.reg_login]',
                'errors'=>[
                    'required'=>'O login é origatório.',
                    'is_unique'=>'O login já existe.',
                ]
            ],
             'telefone'=>[
                'rules'=>'required|is_unique[acesso_login.reg_telefone]|exact_length[15]',
                'errors'=>[
                    'required'=>'Informe um telefone.',
                    'is_unique'=>'Esse telefone já existe.',
                    'exact_length'=>'O telefone deve conter 15 caracteres.',
                ]
            ],
            'colab_status'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Informe um status.',
                ]
            ],
             'colab_email'=>[
                  'rules'=>'required|max_length[100]|valid_email|is_unique[acesso_login.reg_email]',
                  'errors'=>[
                      'required'=>'Informe um email.',
                      'max_length'=>'Email muito longo.',
                      'valid_email'=>'Informe um email válido.',
                      'is_unique'=>'O email já existe.',
                  ]
            ],
            'colab_nivel'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Nível é obrigatório.'
                ]
            ],
            'colab_cpf'=>[
                'rules'=>'required|is_unique[lojas.loja_email]|exact_length[14]',
                'errors'=>[
                    'required'=>'O cpf é obrigatório.',
                    'is_unique'=>'O cpf já existe.',
                    'exact_length'=>'O cpf deve ter 14 caracteres.',
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $id = $this->request->getPost('hidden_id_colab');
             $data = [
                 'reg_nome'          =>  $this->request->getPost('colaborador'),
                 'reg_telefone'      =>  $this->request->getPost('telefone'),
                 'reg_cpf'           =>  $this->request->getPost('colab_cpf'),
                 'reg_email'         =>  $this->request->getPost('colab_email'),
                 'reg_login'         =>  $this->request->getPost('colab_login'),
                 'status'            =>  $this->request->getPost('colab_status'),
                 'role'              =>  $this->request->getPost('colab_nivel'),
             ];

             $query = $register_login->update($id, $data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Usuário cadastrado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Algo deu errado']);
             }
        }
    }
}
