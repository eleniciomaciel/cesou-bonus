<?php

namespace App\Validation;

class LimpaStringValidation
{
    // public function custom_rule(): bool
    // {
    //     return true;
    // }

    public function limpar_texto($str)
    { 
        return preg_replace("/[^0-9]/", "", $str); 
    }
}
