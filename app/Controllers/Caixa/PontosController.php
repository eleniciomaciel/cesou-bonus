<?php

namespace App\Controllers\Caixa;

use App\Controllers\BaseController;

class PontosController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "Caixa") {
            echo 'Access denied';
            return redirect('/');
            exit;
        }
    }
    
    public function index()
    {
        return view('Caixa/pages/page-pontos');
    }
}
