<?php

namespace App\Controllers\Caixa;

use App\Controllers\BaseController;
use App\Models\CompensapontoModel;
use App\Models\PontosModel;

class CaixaController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "Caixa") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        $model = model(CompensapontoModel::class);
        $data = [
            'clientes' => $model->getClientePontos()
        ];

        return view('Caixa/Home_caixa', $data);
    }

    public function clientePontosList()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_clie');
            $model = model(PontosModel::class);
            $cliente = $model->getPontos($id);
            return json_encode($cliente);
        }
    }
    
    public function clienteCompensaPontos() {

        $request = $this->request->getJSON(); // Get the JSON data sent via Ajax

        // Perform validation if needed
        $validationRules = [
            'id_do_ponto'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Sessão expirou.',
                ],
            ],
            'sou_cliente'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Faltando informação do cliente.',
                ],
            ],
            'id_cli_ponto'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Necessário informar os pontos.',
                ],
            ],
            'selectPontosOption'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Escolha uma pontuação por favor.',
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            $response = [
                'status' => 'error',
                'errors' => $this->validator->getErrors()
            ];
        } else {
            $model = model(PontosModel::class);
            $id = $this->request->getPost('id_do_ponto');
            $id_do_cliente = $this->request->getPost('id_do_cliente');
            $ponto = $this->request->getPost('selectPontosOption'); 
            $ponto_atual = $this->request->getPost('id_cli_ponto'); 
            $resiltado =  $ponto_atual - $ponto;
            
            $data = [
                'point_pontos' => $resiltado
            ];
            
            $model->update($id, $data);

            $modelPontos = model(CompensapontoModel::class);
            $modelPontos->save([
                'cliente_id'   =>  $id_do_cliente,
                'pontos'       =>  $ponto
            ]);

            $response = [
                'status' => 'success',
                'message' => 'Recompnsa creditada com sucesso!'
            ];
        }

        return $this->response->setJSON($response);
    }



}
