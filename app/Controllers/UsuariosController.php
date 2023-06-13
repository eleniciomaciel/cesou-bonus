<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UsuariosController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "user") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        return view("Usuarios/Usuario-Home");
    }

    public function bradesco()
    {
        return view('Usuarios/partial/pages/page-bradesco');
    }

    public function levaTraz()
    {
        return view('Usuarios/partial/pages/page-leva-traz');
    }

    public function shoppingCashback()
    {
        return view('Usuarios/partial/pages/page-cashback');
    }
}
