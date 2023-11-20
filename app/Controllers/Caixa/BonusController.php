<?php

namespace App\Controllers\Caixa;

use App\Controllers\BaseController;

class BonusController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "Caixa") {
            return redirect('/');
            exit;
        }
    }
    public function index()
    {
        return view('Caixa/pages/page-bonus');
    }
}
