<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CupomModel;
use App\Models\LojaModel;
use App\Models\RegistroUsuarioModel;
use \Hermawan\DataTables\DataTable;

class CupomUsuarioController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "user") {
            echo 'Access denied';
            exit;
        }
        helper('number');
        helper('convertemoeda');
    }

    public function index()
    {
        $model_cupom = model(CupomModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'resultados'=>[
                 'rules'=>'required|is_unique[cupom.cup_qrcode_cupom]',
                 'errors'=>[
                     'required'=>'É necessário ler o qrcode do cupom.',
                     'is_unique'=>'Ops! Esse QR CODE já foi cadastrado.',
                 ]
             ],
             'valor_chave'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'A chave da nota é obrigatório.',
                  ]
            ],
            'data_compra'=>[
                'rules'=>'required|valid_date',
                'errors'=>[
                    'required'=>'Data da compra é obrigatório.',
                    'valid_date'=>'Escolha uma data válida.',
                ]
          ],
            'valor_comprado'=>[
                'rules'=>'required|validaCuponValor[valor_comprado]',
                'errors'=>[
                    'required'=>'Valor da compra é necessário.',
                    'validaCuponValor'=>'Você comprou R${value} é o valor deve ser maior que R$100,00.',
                ]
            ],
            'cnpj_vededor'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'CNPJ é necessário.',
                ]
            ],
            'empresa_vendedora'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Empresa da compra é obrigatório.'
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $data = [
                 'cup_qrcode_cupom'             =>  $this->request->getPost('resultados'),
                 'cup_key_cupom'                =>  $this->request->getPost('valor_chave'),
                 'cup_data_cupom'               =>  $this->request->getPost('data_compra'),
                 'cup_valor_cupom'              =>  money_convert($this->request->getPost('valor_comprado')),
                 'cup_cnpj_cupom'               =>  $this->request->getPost('cnpj_vededor'),
                 'cup_empresa_vendedora_cupom'  =>  $this->request->getPost('empresa_vendedora'),
                 'cup_data_vencimento_cupom'    =>  date('Y-m-d', strtotime($this->request->getPost('data_compra').'+ 30 days')),
                 'cup_usuario_id'               =>  $this->request->getPost('id_usuario_cashback'),
             ];
             $query = $model_cupom->insert($data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Cupom cadastrado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Existem alguns erros, verifique por favor']);
             }
        }
    }

    public function listaCupons()
    {
        $db = model(CupomModel::class);
        
        $id = session()->get('id');
        $data_dia_hoje = date('Y-m-d');
        $builder = $db->select('cup_id, cup_status, cup_pontos,cup_data_cupom, cup_data_vencimento_cupom')
        ->where('cup_status', 'Ativo')
        ->where('cup_data_vencimento_cupom >=', $data_dia_hoje)
        ->where('cup_usuario_id', $id);
    
        return DataTable::of($builder)
        ->add('action', function($row){
            return '
            <button class="gerarQrCode btn btn-icon btn-3 btn-primary" type="button" id="'.$row->cup_id.'">
                <span class="btn-inner--icon"><i class="ni ni-basket"></i></span>
                <span class="btn-inner--text">Trocar</span>
            </button>
            ';
        })->format('cup_data_vencimento_cupom', function($value){
            return date('d/m/Y', strtotime($value));
        })->format('cup_status', function($value){
             return '<span class="badge bg-gradient-info">'.$value.'</span>';
        })
        ->add('progress', function($row){


            $data_cadastro = $row->cup_data_cupom;
            $data_hoje = date('Y-m-d');
            $data_resgate = $row->cup_data_vencimento_cupom;

            /**
             * dias total
             */
            $date_inicial   =   date_create($data_cadastro);
            $date_final     =   date_create($data_resgate);
            $diff_total     =   date_diff($date_inicial,$date_final);
            $dias_total     = $diff_total->format("%a");


            /**
             * dias restantes
             */
            $date1  =   date_create($data_hoje);
            $date2  =   date_create($data_resgate);
            $diff   =   date_diff($date1,$date2);
            $dias_restante = $diff->format("%a");

            /**
             * percentual restante
             */
            $dias_progress = ceil(100 / $dias_total * $dias_restante);
            $percentual_dias = round($dias_total  * 100 / $dias_restante) ;
            
            return
            '
            <div class="progress-wrapper">
                <div class="progress-info">
                    <div class="progress-percentage">
                        <span class="text-sm font-weight-bold">Faltam: '.$dias_total.' dias para vencer </span>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="'.$percentual_dias.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentual_dias.'%;"></div>
                </div>
            </div>
            ';
        })
        ->toJson(true);
    }

    public function qrcodeBuild()
    {
        if($this->request->getVar('id'))
        {
            $model = model(CupomModel::class);
            $user_data = $model->where('cup_id', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
    }

    public function getTotalCubonsAtivivo()
    {
        $usuarios_id = session()->get('id');
        $data_hoje = date('Y-m-d');

        $db = \Config\Database::connect();
        $query = $db->query('SELECT count(cup_id) as total_cupons FROM cupom WHERE cup_status =  "Ativo" AND cup_usuario_id  = "'.$usuarios_id.'"');
        $row   = $query->getRow();
        echo $row->total_cupons;
    }

    public function getCubonsCompensados()
    {
        $usuarios_id = session()->get('id');
        $data_hoje = date('Y-m-d');

        $db = \Config\Database::connect();
        $query = $db->query('SELECT count(cup_id) as total_compensados FROM cupom WHERE cup_status =  "Compensado" AND cup_usuario_id  = "'.$usuarios_id.'"');
        $row   = $query->getRow();
        echo $row->total_compensados;
    }


    public function getParaTrocas()
    {
        $id = session()->get('id');
        $builder = model(CupomModel::class);
        $query = $builder->selectCount('cup_id')->where('cup_usuario_id', $id)->get();
        $row   = $query->getRow();
        echo $row->cup_id;
    }

    public function getCuponsListVencidosTrocados()
    {
        $id = session()->get('id');
        $builder = model(CupomModel::class);
        $query = $builder->get();

        $output = '';

        if (isset($query)) {
            foreach ($query->getResult() as $row) {
                
                if ($row->cup_status == 'Ativo') {
                    $output .= '
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="ni ni-basket text-info text-gradient"></i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">'.$row->cup_status.'</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Válido: '.date('d/m/Y', strtotime($row->cup_data_vencimento_cupom)).'</p>
                        </div>
                    </div>
                    ';
                }elseif ($row->cup_status == 'Compensado' && $row->cup_data_vencimento_cupom <= date('Y-m-d')) {
                    $output .= '


                    <div class="timeline-block mb-3">
                    <span class="timeline-step">
                        <i class="ni ni-fat-remove text-danger text-gradient"></i>
                    </span>
                    <div class="timeline-content">
                        <h6 class="text-dark text-sm font-weight-bold mb-0">Vencido</h6>
                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">'.date('d/m/Y', strtotime($row->cup_data_vencimento_cupom)).'</p>
                    </div>
                </div>

                    ';
                }elseif ($row->cup_data_vencimento_cupom >= date('Y-m-d')) {
                    $output .= '
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="ni ni-tag text-danger text-gradient"></i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">'.$row->cup_status.'</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Resgatado: '.date('d/m/Y', strtotime($row->cup_data_vencimento_cupom)).'</p>
                        </div>
                    </div>
                    ';
                }
            }
        } else {
            $output .= '
            <div class="alert alert-warning" role="alert">
                <strong>Warning!</strong> Sem registro no momento.
            </div>
            ';
        }
        echo $output;
    }

    public function getListaPromocao()
    {
        $builder = model(LojaModel::class);
        $query = $builder->get();

        $output = '';

        if (isset($query)) {
            foreach ($query->getResult() as $row) {
                
                $output .= '
                <div class="col-lg-12 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex">
                                <div class="avatar avatar-xl bg-gradient-dark border-radius-md p-2">
                                    <img src="https://demos.creative-tim.com/soft-ui-dashboard-pro/assets/img/small-logos/logo-slack.svg" alt="slack_logo">
                                </div>
                                <div class="ms-3 my-auto">
                                    <h6>Loja: '.esc($row->loja_nome_empresarial).'</h6>
        
                                </div>
                            </div>
                            <p class="text-sm mt-3"> '.esc($row->lojas_promocional).' </p>
                            <hr class="horizontal dark">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-sm mb-0">'.esc(round($row->lojas_percentual)).'% desconto</h6>
                                    <p class="text-secondary text-sm font-weight-bold mb-0">Desconto para resgate na loja parceira</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
        } else {
            $output .= '
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <a href="javascript:;">
                        <i class="fa fa-plus text-secondary mb-3" aria-hidden="true"></i>
                        <h5 class=" text-secondary"> Nenhuma promoção no momento </h5>
                    </a>
                </div>
            </div>
            ';
        }
        echo $output;
    }

    public function getListaMenuPromocional()
    {
        $builder = model(LojaModel::class);
        $query = $builder->get();

        $output = '';

        if (isset($query)) {
            foreach ($query->getResult() as $row) {
                
                $output .= '
                    <li>
                        <a class="dropdown-item border-radius-md" href="javascript:;">
                            <div class="d-flex py-1">
                                <div class="avatar avatar-sm bg-gradient-primary  me-3  my-auto">


                                    <svg class="text-white" width="12px" height="12px" viewBox="0 0 42 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>basket</title> <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Rounded-Icons" transform="translate(-1869.000000, -741.000000)" fill="#FFFFFF" fill-rule="nonzero"> <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)"> <g id="basket" transform="translate(153.000000, 450.000000)"> <path class="color-background" d="M34.080375,13.125 L27.3748125,1.9490625 C27.1377583,1.53795093 26.6972449,1.28682264 26.222716,1.29218729 C25.748187,1.29772591 25.3135593,1.55890827 25.0860125,1.97535742 C24.8584658,2.39180657 24.8734447,2.89865282 25.1251875,3.3009375 L31.019625,13.125 L10.980375,13.125 L16.8748125,3.3009375 C17.1265553,2.89865282 17.1415342,2.39180657 16.9139875,1.97535742 C16.6864407,1.55890827 16.251813,1.29772591 15.777284,1.29218729 C15.3027551,1.28682264 14.8622417,1.53795093 14.6251875,1.9490625 L7.919625,13.125 L0,13.125 L0,18.375 L42,18.375 L42,13.125 L34.080375,13.125 Z" opacity="0.595377604"></path> <path class="color-background" d="M3.9375,21 L3.9375,38.0625 C3.9375,40.9619949 6.28800506,43.3125 9.1875,43.3125 L32.8125,43.3125 C35.7119949,43.3125 38.0625,40.9619949 38.0625,38.0625 L38.0625,21 L3.9375,21 Z M14.4375,36.75 L11.8125,36.75 L11.8125,26.25 L14.4375,26.25 L14.4375,36.75 Z M22.3125,36.75 L19.6875,36.75 L19.6875,26.25 L22.3125,26.25 L22.3125,36.75 Z M30.1875,36.75 L27.5625,36.75 L27.5625,26.25 L30.1875,26.25 L30.1875,36.75 Z"></path> </g> </g> </g> </g> </svg>
      


                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="text-sm font-weight-normal mb-1">
                                    '.esc($row->loja_nome_empresarial).'
                                    </h6>
                                    <p class="text-xs text-secondary mb-0 ">
                                        <i class="fa fa-clock me-1" aria-hidden="true"></i>
                                        Ofertando: '.esc(round($row->lojas_percentual)).'% de desconto
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                ';
            }
        } else {
            $output .= '
            <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                        <div class="my-auto">
                            <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">New album</span> Sem Registro o momento
                            </h6>
                        </div>
                    </div>
                </a>
            </li>
            ';
        }
        echo $output;
    }

    public function atualizaPerfil()
    {
        $model_login = model(RegistroUsuarioModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'perfil_name'=>[
                 'rules'=>'required',
                 'errors'=>[
                     'required'=>'Usuário é obrigatório.',
                 ]
             ],
             'perfil_cpf'=>[
                  'rules'=>'required',
                  'errors'=>[
                      'required'=>'O cpf é obrigatório.',
                  ]
            ],
            'perfil_cep'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'cep é obrigatório.',
                ]
          ],
            'perfil_telefone'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'O telefone é necessário.',
                ]
            ],
            'perfil_uf'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'A UF é necessário.',
                ]
            ],
            'perfil_cidade'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'A pcidade é obrigatório.'
                ]
            ],
            'perfil_bairro'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Bairro é obrigatório.'
                ]
            ],
            'perfil_endereco'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Endereço é obrigatório.'
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $id = $this->request->getPost('id_perfil');
             $data = [
                 'reg_nome'       =>  $this->request->getPost('perfil_name'),
                 'reg_telefone'   =>  $this->request->getPost('perfil_telefone'),
                 'reg_cpf'        =>  $this->request->getPost('perfil_cpf'),
                 'reg_cep'        =>  $this->request->getPost('perfil_cep'),
                 'reg_uf'         =>  $this->request->getPost('perfil_uf'),
                 'reg_cidade'     =>  $this->request->getPost('perfil_cidade'),
                 'reg_bairro'     =>  $this->request->getPost('perfil_bairro'),
                 'reg_endereco'   =>  $this->request->getPost('perfil_endereco'),
             ];
             $query = $model_login->update($id, $data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Cadastro atualizado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Existem alguns erros, verifique por favor']);
             }
        }
    }

    public function atualizaPerfilLogin()
    {
        $model_login = model(RegistroUsuarioModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'acesso_email'=>[
                 'rules'=>'required|valid_email',
                 'errors'=>[
                     'required'=>'Usuário é obrigatório.',
                     'valid_email'=>'Digite um email válido.',
                 ]
             ],
             'acesso_senha'=>[
                  'rules'=>'required|regex_match[/^[a-zA-Z]\w{5,10}$/]',
                  'errors'=>[
                      'required'=>'A senha é obrigatório.',
                      'regex_match'=>'O primeiro caractere da senha deve ser uma letra, deve conter no mínimo 5 caracteres e no máximo 10 caracteres e nenhum outro caractere além de letras, números e sublinhado pode ser usado.',
                  ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $id = $this->request->getPost('id_perfil_login');
             $data = [
                 'reg_email'   =>  $this->request->getPost('acesso_email'),
                 'reg_senha'   =>  password_hash($this->request->getPost('acesso_senha'), PASSWORD_DEFAULT),
             ];
             $query = $model_login->update($id, $data);
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Cadastro atualizado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Existem alguns erros, verifique por favor']);
             }
        }
    }
}


