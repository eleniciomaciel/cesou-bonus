<?php

namespace App\Validation;

use App\Models\BradescoModel;
use App\Models\CupomModel;
use App\Models\LevaTrazModel;

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
        $valor_compra = intval($data['valor_comprado']);
        $valor_100 = intval(100);
        if ($valor_compra < $valor_100 ) {
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
        $data_exists = $model->where('lvt_time', $radio_hora)->where('lvt_date', $radio_data)->where('lvt_status !=', 'Cancelado')->first();
        if ($data_exists) {
            return false;
        }
        return true;
    }
}