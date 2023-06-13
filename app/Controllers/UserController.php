<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\RegistroUsuario;
use App\Models\RegistroUsuarioModel;

class UserController extends BaseController
{
    public function login()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[15]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email ou senha estão incorretas.",
                    'min_length' => "A senha deve ter no mínimo 6 caracteres de manaho.",
                    'max_length' => "A senha deve ter no máximo 15 caracteres de manaho.",
                ],
            ];

            if (!$this->validate($rules, $errors)) {

                return view('login', [
                    "validation" => $this->validator,
                ]);

            } else {
                $model = model(RegistroUsuarioModel::class);
                //dd($model);
                $user = $model->where('reg_email', $this->request->getVar('email'))->first();
                
                // Stroing session values
                $this->setUserSession($user);

                // Redirecting to dashboard after login
                if($user['role'] == "admin"){
                    return redirect()->to(base_url('admin'));
                }elseif($user['role'] == "gestor"){
                    return redirect()->to(base_url('gestor'));
                }
                elseif($user['role'] == "user"){
                    return redirect()->to(base_url('user'));
                }
                elseif($user['role'] == "bradesco_panel"){
                    return redirect()->to(base_url('bradesco_panel'));
                }
            }
        }
        return view('login');
    }

    private function setUserSession($user)
    {
        $data = [
            'id'            => $user['id'],
            'reg_nome'      => $user['reg_nome'],
            'reg_cpf'       => $user['reg_cpf'],
            'reg_cep'       => $user['reg_cep'],
            'reg_uf'        => $user['reg_uf'],
            'reg_telefone'  => $user['reg_telefone'],
            'reg_email'     => $user['reg_email'],
            'reg_cidade'    => $user['reg_cidade'],
            'reg_bairro'    => $user['reg_bairro'],
            'reg_endereco'  => $user['reg_endereco'],
            'status'        => $user['status'],
            'isLoggedIn'    => true,
            "role"          => $user['role'],
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    public function acesso()
    {
        $register_login = model(RegistroUsuarioModel::class);
        $validation = \Config\Services::validation();
        
        $this->validate([
             'reg_nome'=>[
                 'rules'=>'required|is_unique[acesso_login.reg_nome]|max_length[100]|min_length[10]',
                 'errors'=>[
                     'required'=>'Nome completo deve ser preenchido',
                     'max_length'=>'Você ultrapassou de caracteres.',
                     'min_length'=>'O nome está muito curto.',
                 ]
             ],
             'reg_telefone'=>[
                'rules'=>'required|is_unique[acesso_login.reg_telefone]|exact_length[15]',
                'errors'=>[
                    'required'=>'informe um telefone',
                    'is_unique'=>'Esse telefone já existe.',
                    'exact_length'=>'O telefone deve conter 14 caracteres.',
                ]
            ],
            'reg_cpf'=>[
                'rules'=>'required|is_unique[acesso_login.reg_cpf]',
                'errors'=>[
                    'required'=>'informe um cpf',
                    'is_unique'=>'O cpf informado já está cadastrado.',
                ]
            ],
             'reg_cep'=>[
                  'rules'=>'required|exact_length[10]',
                  'errors'=>[
                      'required'=>'informe um cep',
                      'exact_length'=>'informe um cep'
                  ]
            ],
            'reg_uf'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'informe a UF'
                ]
          ],
            'reg_cidade'=>[
                'rules'=>'required|max_length[50]',
                'errors'=>[
                    'required'=>'informe uma cidade',
                    'max_length'=>'A cidade deve ter até 50 caracteres.',
                ]
            ],
            'reg_bairro'=>[
                'rules'=>'required|max_length[50]',
                'errors'=>[
                    'required'=>'informe um bairro.',
                    'max_length'=>'O bairro deve ter até 50 caracteres.',
                ]
            ],
            'reg_endereco'=>[
                'rules'=>'required|max_length[100]',
                'errors'=>[
                    'required'=>'informe um endereço',
                    'max_length'=>'O endereço deve ter até 100 caracteres.',
                ]
            ],
            'reg_email'=>[
                'rules'=>'required|valid_email|is_unique[acesso_login.reg_email]',
                'errors'=>[
                    'required'=>'informe um cpf',
                    'is_unique'=>'O email informado já existe.',
                    'valid_email'=>'Informe um email válido.',
                ]
            ],
            'reg_senha'=>[
                'rules'=>'required|regex_match[/^[a-zA-Z]\w{5,10}$/]',
                'errors'=>[
                    'required'=>'informe uma senha.',
                    'regex_match'=>'O primeiro caractere da senha deve ser uma letra, deve conter no mínimo 5 caracteres e no máximo 10 caracteres e nenhum outro caractere além de letras, números e sublinhado pode ser usado.',
                ]
            ],
            'confirm_password'=>[
                'rules'=>'required|matches[reg_senha]',
                'errors'=>[
                    'required'=>'informe uma contra senha',
                    'matches'=>'A confirmação de senha está diferente',
                ]
            ],
            'reg_flexCheckDefault'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Aceite os termos por favor.',
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $data = [
                 'reg_nome'         =>  strtoupper($this->request->getPost('reg_nome')),
                 'reg_telefone'     =>  $this->request->getPost('reg_telefone'),
                 'reg_cpf'          =>  $this->request->getPost('reg_cpf'),
                 'reg_cep'          =>  $this->request->getPost('reg_cep'),
                 'reg_uf'           =>  strtoupper($this->request->getPost('reg_uf')),
                 'reg_cidade'       =>  strtoupper($this->request->getPost('reg_cidade')),
                 'reg_bairro'       =>  strtoupper($this->request->getPost('reg_bairro')),
                 'reg_endereco'     =>  strtoupper($this->request->getPost('reg_endereco')),
                 'reg_email'        =>  strtolower($this->request->getPost('reg_email')),
                 'reg_senha'        =>  password_hash($this->request->getPost('reg_senha'), PASSWORD_DEFAULT),
                 'termos_uso'       =>  $this->request->getPost('reg_flexCheckDefault'),
             ];

             $query = $register_login->insert($data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Registro cadastrado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Algo deu errado']);
             }
        }
    }

    public function fazSenhaUsuario()
    {
        $register_login = model(RegistroUsuarioModel::class);
        $validation = \Config\Services::validation();
        
        $this->validate([
            'reg_cpf'=>[
                'rules'=>'required|is_not_unique[acesso_login.reg_cpf]',
                'errors'=>[
                    'required'=>'informe a UF',
                    'is_not_unique'=>'O cpf não existe em nossos registros.',
                ]
          ],
           'reg_email'=>[
                'rules'=>'required|valid_email|is_not_unique[acesso_login.reg_email]|validaExisteDados[reg_email,reg_cpf]',
                'errors'=>[
                    'required'=>'informe um cpf',
                    'is_not_unique'=>'O email informado já existe.',
                    'valid_email'=>'Informe um email válido.',
                    'validaExisteDados'=>'Esse cpf não pertence ao email informado ou seu acesso foi suspenso.',
                ]
            ],
            'reg_senha'=>[
                'rules'=>'required|regex_match[/^[a-zA-Z]\w{5,10}$/]',
                'errors'=>[
                    'required'=>'informe uma senha.',
                    'regex_match'=>'O primeiro caractere da senha deve ser uma letra, deve conter no mínimo 5 caracteres e no máximo 10 caracteres e nenhum outro caractere além de letras, números e sublinhado pode ser usado.',
                ]
            ],
            'confirm_password'=>[
                'rules'=>'required|matches[reg_senha]',
                'errors'=>[
                    'required'=>'informe uma contra senha',
                    'matches'=>'A confirmação de senha está diferente',
                ]
            ],
            'reg_flexCheckDefault'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Aceite os termos por favor.',
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{

            /**
             * verifica o cpf do usuário
             */
            $db = \Config\Database::connect();
            $id_cpf = $this->request->getPost('reg_cpf');
            $query = $db->query('SELECT id, reg_cpf FROM acesso_login WHERE reg_cpf = "'.$id_cpf.'"');
            $row   = $query->getRow();
            $id = $row->id;
             //Insert data into db
             $data = [
                 'reg_senha'        =>  password_hash($this->request->getPost('reg_senha'), PASSWORD_DEFAULT),
                 'termos_uso'       =>  $this->request->getPost('reg_flexCheckDefault'),
             ];
             //$register_login->where('reg_cpf', $id_cpf);
             $query = $register_login->update($id, $data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Registro cadastrado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Algo deu errado']);
             }
        }
    }
}
