<?php

namespace App\Validation;

use App\Models\BradescoModel;
use App\Models\CupomModel;
use App\Models\LevaTrazModel;
use App\Models\SenhaCaixaModel;

class StatusCupomValidation
{
    public function status_cupom($str, string $fields, array $data): bool
    {
        $model = model(CupomModel::class);
        $status = $model->where('cup_status', $data['usercup_status'])->first();
        if ($status['cup_status'] == 'Compensado') {
            return false;
        }
        return true;
    }

    public function validaCuponValor($str, string $fields, array $data): bool
    {
        $valor_total = (double) str_replace(',', '.', str_replace('.', '', $data['valor_comprado']));
        $valor_const = "100.00";
        $valor_100 = (double)$valor_const;
        if ($valor_total < $valor_100 ) {
            return false;
        }
        return true;
    }

    public function validaCupom($str, string $fields, array $data): bool{
        $cupom = 'http://nfe.sefaz.ba.gov.br/servicos/nfce/qrcode.aspx?p=29230511114552000147650030001292531590680263|2|1|1|12B1F9B113B48C4C4F00CB341CE7F4F3EF74D60C';
        if ($data['valor_chave'] == $cupom) {
            return false;
        }
        return true;
    }

    public function validaHoras($str, string $fields, array $data): bool
    {
        $model = model(BradescoModel::class);
        $dia = $data['agenda_data'];
        $horas = $data['agenda_hora'];
        $minutos = $data['agenda_minut'];
        $tempo = $dia.' '.$horas.':'.$minutos.':00';
        $tempo_exists_db = $model->where('brad_date_time', $tempo)->where('status !=','Cancelado')->first();
        if ($tempo_exists_db) {
           return false;
        }
        return true;
    }

    public function validaHoraLevaTraz($str, string $fields, array $data): bool
    {
        $model = model(LevaTrazModel::class);
        $radio_hora = $data['hora_lvt'];
        $radio_data = $data['data_lvt'];
        $data_exists = $model->where('lvt_time', $radio_hora)
                            ->where('lvt_date', $radio_data)
                            ->where('lvt_status !=', 'Cancelado')
                            ->first();
                            
        if ($data_exists) {
            return false;
        }
        return true;
    }

    public function verificaHoraHoje($str, string $fields, array $data): bool
    {
        $radio_hora = $data['hora_lvt'];
        $radio_data = $data['data_lvt'];
        $dia_solicita = $radio_data.' '.$radio_hora;
        $hora_hoje = date("Y-m-d H:i");

                            
        if ($dia_solicita <= $hora_hoje) {
            return false;
        }
        return true;
    }

    public function validaSenhaCaixa($str, string $fields, array $data): bool
    {
        $model = model(SenhaCaixaModel::class);
        $senha = $data['senha_caixa'];
        $data_exists = $model->where('senha_caixa', $senha)->first();
        if ($data_exists) {
            return true;
        }
        return false;
    }
}
