<?php

if (!function_exists("convertePontos")) {
    function convertePontos(int $pontos)
    {
        $total = 1;
        for ($x = 200; $x <= $pontos; $x+= 200) {
            $total_pontos = $total ++;
        }
        return $total_pontos;
    }
}