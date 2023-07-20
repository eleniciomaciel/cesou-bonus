<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CupomModel;
use App\Models\DescontolojaModel;
use App\Models\RegistroUsuarioModel;
use \Hermawan\DataTables\DataTable;
use PHPUnit\TextUI\XmlConfiguration\Group;

class GestorController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "gestor") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        
        $db = \Config\Database::connect();
        $builder = $db->table('descontolojas');
        $query = $builder->select("COUNT(dl_id) as count, dl_valor_venda as s, DAYNAME(dl_data) as day");
        $query = $builder->where("DAY(dl_data) GROUP BY DAYNAME(dl_data), s")->get();
        $record = $query->getResult();
        $products = [];
        foreach($record as $row) {
            $products[] = array(
                'day'   => strftime('%a', strtotime($row->day)),
                'sell' => floatval($row->s)
            );
        }
        
        $data['products'] = ($products);    
        //return view('chart', $data);

        return view("Gestor/home-gestor", $data);
    }

    public function getDadosCupom(int $id = null)
    {
        if (is_null($id)) {
            echo json_encode(['code'=>'1', 'mensage'=>'leia um código válido.']);
        } else {
            if($id)
            {
                $model = model(CupomModel::class);
                $user_data = $model->join('acesso_login', 'acesso_login.id = cupom.cup_usuario_id')
                ->where('cup_id', $id)->first();
                echo json_encode($user_data);
            }
        }
        
    }

    public function trocaQrcode()
    {

        $model_cupom = model(CupomModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'userusuario'=>[
                 'rules'=>'required',
                 'errors'=>[
                     'required'=>'Cliente é obrigatório.',
                 ]
             ],
            
            'usercpf'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Ops! cpf é obrigatório.',
                ]
            ],
            'usercup_status'=>[
                'rules'=>'required|status_cupom[usercup_status]',
                'errors'=>[
                    'required'=>'Cliente é obrigatório.',
                    'status_cupom'=>'O cupon já compensado, utilize outro por favor.',
                ]
            ],
            'valor_venda'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Informe o valor da venda.',
                ]
            ],
            'valor_desconto'=>[
                'rules'=>'required|alpha_numeric_punct',
                'errors'=>[
                    'required'=>'Infrorme o percentual do desconto.',
                    'alpha_numeric_punct'=>'Informe um valor percentual.',
                ]
            ],
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
            $id = $this->request->getPost('hidden_id_cupon');

            $id_logista = session()->get('id');
            $db = db_connect();
            $query = $db->query('SELECT loja_id, loja_usuario_id FROM lojas WHERE loja_usuario_id = "'.$id_logista.'";');
            $row = $query->getRow();
            //dd($row->loja_usuario_id);
             $data = [
                 'cup_status'                =>  'Compensado',
                 'cup_loja_do_desconto_id'   =>  $id_logista,
             ];
             $query = $model_cupom->update($id, $data);
             $venda = (double) str_replace(',', '.', str_replace('.', '', $this->request->getPost('valor_venda')));

             $desconto = $this->request->getPost('valor_desconto');
             $troco = $desconto / 100 * $venda;
             

             $dado_usuario      = $this->request->getPost('usuario_id');
             $dado_chave_sf     = $this->request->getPost('hidden_id_cupon');
             $dado_vl_venda     = $venda;
             $dado_vl_desconto  = $this->request->getPost('valor_desconto');
             $dado_vl_troco     = $troco;

             $this->adicionaCuponCompensado($dado_usuario, $dado_chave_sf, $dado_vl_venda, $dado_vl_desconto, $dado_vl_troco);
             
             if($query){
                 echo json_encode(['code'=>1,'msg'=>'Cupom trocado com sucesso.']);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'Têm error ai, verifique por favor.']);
             }
        }
    }

    /**
     * INSERIR NO HISTÓRICO DE VENDA DA LOJA
     */
    public function adicionaCuponCompensado($dado_usuario, $id_cupon, $dado_vl_venda, $dado_vl_desconto, $dado_vl_troco)
    {
        $id_logista = session()->get('id');
        $db = db_connect();
        $query = $db->query('SELECT loja_id, loja_usuario_id FROM lojas WHERE loja_usuario_id = "'.$id_logista.'";');
        $row = $query->getRow();

        $model = model(DescontolojaModel::class);
        $data = $model->save([
            'dl_loja_id'            => $row->loja_id,
            'dl_cliente_id'         => $dado_usuario,
            'dl_chave_cefaz'       =>  $id_cupon,
            'dl_valor_venda'        => $dado_vl_venda,
            'dl_total_desconto'     => $dado_vl_desconto,
            'dl_valor_desconto'     => $dado_vl_troco,
            'status_pontos'         => 'Trocado',
            'dl_data'               => date('Y-m_d'),
        ]);
        return $data;
    }
    /**
     * lista dados dos clientes
     */
    public function listClientes()
    {
        return view('Gestor/partial/pages/page-clientes');
    }

    public function clientesLista()
    {
        $db = model(DescontolojaModel::class);
        $builder = $db->select('log.reg_nome, dl_valor_venda, dl_valor_desconto, dl_data')
        ->join('acesso_login AS log', 'log.id = descontolojas.dl_cliente_id')
        //->join('acesso_login AS log', 'log.id = cupom.cup_usuario_id')
        ->where('status_pontos', 'Trocado');

        return DataTable::of($builder)
        ->format('dl_data', function($value){
            return date('d/m/Y', strtotime($value));
        })
        ->format('dl_valor_venda', function($value){
            return 'R$'.number_format($value, 2,'.',',');
        })
        ->format('dl_valor_desconto', function($value){
            return 'R$'.number_format($value, 2,'.',',');
        })
        ->postQuery(function($builder){
            $builder->orderBy('dl_data', 'desc');
        })->toJson();
    }

    public function clientesAtivos()
    {
        

        $dia_hoje = date('Y-m-d');

        $db = model(CupomModel::class);
        $builder = $db->table('cupom')
        ->select('DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) AS dia_faltando, log.reg_nome,log.reg_telefone, cupom.cup_data_vencimento_cupom, cupom.cup_status,cup_data_cupom')
        ->join('acesso_login AS log', 'log.id = cupom.cup_usuario_id')
        ->where('cup_status', 'Ativo')
        ->where('DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) <=', 10);

        return DataTable::of($builder)
        ->format('cup_data_vencimento_cupom', function($value){
            return date('d/m/Y', strtotime($value));
        })
        ->add('status_vencimento', function($row){

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
            $percentual_dias = round($dias_total  * 100 / $dias_restante) ;

            return '
            <div class="progress-wrapper">
                <div class="progress-info">
                    <div class="progress-percentage">
                    <span class="text-sm font-weight-bold">Faltam: '.$dias_total.' dias para vencer</span>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="'.$percentual_dias.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentual_dias.'%;"></div>
                </div>
            </div>
            ';
        })
        ->postQuery(function($builder){
            $builder->orderBy('cup_data_vencimento_cupom', 'desc');
        })->toJson(true);
    }

    public function clientesAtivosMenorQueVinteMaiorQueDez()
    {
        $db = model(CupomModel::class);
        $builder = $db->table('cupom')
        ->select('log.reg_nome,log.reg_telefone, cupom.cup_data_vencimento_cupom, cupom.cup_status,cup_data_cupom')
        ->join('acesso_login AS log', 'log.id = cupom.cup_usuario_id')
        ->where('cup_status', 'Ativo')
        ->where('DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) <=', 20)
        ->where('DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) >', 10);

        return DataTable::of($builder)
        ->format('cup_data_vencimento_cupom', function($value){
            return date('d/m/Y', strtotime($value));
        })
        ->add('status_vencimento', function($row){

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

            return '
            <div class="progress-wrapper">
                <div class="progress-info">
                    <div class="progress-percentage">
                    <span class="text-sm font-weight-bold">Faltam: '.$dias_total.' dias para vencer</span>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="'.$percentual_dias.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentual_dias.'%;"></div>
                </div>
            </div>
            ';
        })
        ->postQuery(function($builder){
            $builder->orderBy('cup_data_vencimento_cupom', 'desc');
        })->toJson(true);
    }

    public function clientesAtivosMenorQueTrintaMaiorQueVinte()
    {
        $db = model(CupomModel::class);
        $builder = $db->table('cupom')
        ->select('log.reg_nome,log.reg_telefone, cupom.cup_data_vencimento_cupom, cupom.cup_status,cup_data_cupom')
        ->join('acesso_login AS log', 'log.id = cupom.cup_usuario_id')
        ->where('cup_status', 'Ativo')
        ->where('DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) <=', 30)
        ->where('DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) >', 20);

        return DataTable::of($builder)
        ->format('cup_data_vencimento_cupom', function($value){
            return date('d/m/Y', strtotime($value));
        })
        ->add('status_vencimento', function($row){

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

            return '
            <div class="progress-wrapper">
                <div class="progress-info">
                    <div class="progress-percentage">
                    <span class="text-sm font-weight-bold">Faltam: '.$dias_total.' dias para vencer</span>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="'.$percentual_dias.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentual_dias.'%;"></div>
                </div>
            </div>
            ';
        })
        ->postQuery(function($builder){
            $builder->orderBy('cup_data_vencimento_cupom', 'desc');
        })->toJson(true);
    }

    public function cuponsTotalAtivos()
    {
        $db      = \Config\Database::connect();
        $query   = $db->query('SELECT * FROM cupom WHERE cup_status = "Ativo"');
        $results = $query->getResult();
        echo 'Total: ' . count($results);
    }
    public function cuponsNaoVencidos()
    {
        $db      = \Config\Database::connect();
        $query   = $db->query("SELECT * FROM cupom WHERE cup_status = 'Ativo' AND cup_data_vencimento_cupom HAVING  DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) <= 10");
        $results = $query->getResult();
        echo 'Total: ' . count($results);
    }

    public function cuponsMenosVinteMaior10()
    {
        $db      = \Config\Database::connect();
        $query   = $db->query("SELECT * FROM cupom WHERE cup_status = 'Ativo' AND cup_data_vencimento_cupom HAVING  DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) > 10 AND DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) < 20");
        $results = $query->getResult();
        echo 'Total: ' . count($results);
    }

    
    public function cuponsMenosTrintaMaior20()
    {
        $db      = \Config\Database::connect();
        $query   = $db->query("SELECT * FROM cupom WHERE cup_status = 'Ativo' AND cup_data_vencimento_cupom HAVING  DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) > 20 AND DATEDIFF(cupom.cup_data_vencimento_cupom, cupom.cup_data_cupom) <= 30");
        $results = $query->getResult();
        echo 'Total: ' . count($results);
    }

    
    public function cuponsTrocadosComALoja()
    {
        $id_logista = session()->get('id');
        $db = db_connect();
        $query = $db->query('SELECT loja_id, loja_usuario_id FROM lojas WHERE loja_usuario_id = "'.$id_logista.'";');
        $row = $query->getRow();


        $data_hoje = date('Y-m-d');
        $db      = \Config\Database::connect();
        $query   = $db->query("SELECT * FROM descontolojas WHERE dl_loja_id   = '". $row->loja_id."'");
        $results = $query->getResult();
        echo count($results);
    }

    
    public function cuponsTrocadosComALojaClientes()
    {
        $id_logista = session()->get('id');
        $db = db_connect();
        $query = $db->query('SELECT loja_id, loja_usuario_id FROM lojas WHERE loja_usuario_id = "'.$id_logista.'";');
        $row = $query->getRow();

        $db      = \Config\Database::connect();
        $query   = $db->query("SELECT * FROM descontolojas WHERE dl_loja_id   = '". $row->loja_id."' GROUP BY dl_cliente_id");
        $results = $query->getResult();
        echo count($results);
    }

    public function cuponsTrocadosVendasLoja()
    {
        $id_logista = session()->get('id');
        $db = db_connect();
        $query = $db->query('SELECT loja_id, loja_usuario_id FROM lojas WHERE loja_usuario_id = "'.$id_logista.'";');
        $row = $query->getRow();
        $productModel = new DescontolojaModel();
		$result = $productModel->select('sum(dl_valor_venda) as sumQuantities')
        ->where('dl_loja_id', $row->loja_id)
        ->first();
		$data['sum'] = $result['sumQuantities'];
        echo  'R$'.number_format($data['sum'],  2, ',', '.');

    }


    public function getListPotenciaisClientes()
    {
        $data_atual = date('Y-m-d');
        $builder = model(CupomModel::class);
        $builder->select('*');
        $builder->join('acesso_login', 'acesso_login.id = cupom.cup_usuario_id');
        $builder->where('cup_status', 'Ativo');
        $builder->where('cup_data_vencimento_cupom >', $data_atual);
        $query = $builder->get();

        $output = '';

        if ($query) {
            foreach ($query->getResult() as $row) {
                
                $output .= '
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up" aria-hidden="true"></i></button>
                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">'.esc($row->reg_nome).'</h6>
                                <span class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">Vencendo em '.esc(date('d/m/Y', strtotime($row->cup_data_vencimento_cupom))).'</span>
                            </div>
                        </div>
                    </li>
                ';
            }
        } elseif(!$query) {
            $output .= '
            <div class="card border-dashed border-1 text-center h-100">
                <div class="card-body position-relative z-index-1 d-flex flex-column">
                    <div class="position-relative d-flex align-items-center justify-content-center h-100">
                        <img class="w-50 position-relative z-index-2" src="'.base_url().'public/assets/img/illustrations/rocket-white.png" alt="illustration">
                    </div>
                    <a class="text-sm text-secondary font-weight-bold mb-0 icon-move-right mt-2" href="javascript:;">
                        Sem potencias clientes no momento
                        <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            ';
        }
        echo $output;
    }
    
    public function atualizaPerfilGestir()
    {

        $model_login = model(RegistroUsuarioModel::class);
        $validation = \Config\Services::validation();
        $this->validate([
             'g_perfil_nome'=>[
                 'rules'=>'required',
                 'errors'=>[
                     'required'=>'Usuário é obrigatório.',
                 ]
             ],
             'g_perfil_email'=>[
                  'rules'=>'required|valid_email',
                  'errors'=>[
                      'required'=>'O cpf é obrigatório.',
                      'valid_email'=>'Digite um email válido.',
                  ]
            ],
            'g_perfil_senha'=>[
                'rules'=>'required|regex_match[/^[a-zA-Z]\w{5,10}$/]',
                'errors'=>[
                    'required'=>'Senha é obrigatório.',
                    'regex_match'=>'O primeiro caractere da senha deve ser uma letra, deve conter no mínimo 5 caracteres e no máximo 10 caracteres e nenhum outro caractere além de letras, números e sublinhado pode ser usado.',
                ]
          ]
        ]);

        if($validation->run() == FALSE){
            $errors = $validation->getErrors();
            echo json_encode(['code'=>0, 'error'=>$errors]);
        }else{
             //Insert data into db
             $id = session()->get('id');
             $data = [
                 'reg_nome'       =>  $this->request->getPost('perfil_name'),
                 'reg_telefone'   =>  $this->request->getPost('perfil_telefone'),
                 'reg_cpf'        =>  $this->request->getPost('perfil_cpf'),
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
