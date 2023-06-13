<?php

namespace App\Validation;
use App\Models\RegistroUsuarioModel;

class Userrules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new RegistroUsuarioModel();
        $user = $model->where('reg_email', $data['email'])
            ->first();

        if (!$user) {
            return false;
        }

        return password_verify($data['password'], $user['reg_senha']);
    }
}
