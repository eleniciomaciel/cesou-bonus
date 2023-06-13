<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\RegistroUsuarioModel;

class RegistroUsuarioSeeder extends Seeder
{
    public function run()
    {
        $user_object = new RegistroUsuarioModel();

		$user_object->insertBatch([
			[
				"reg_nome" => "Rahul Sharma",
				"reg_telefone" => "(74)9 9958-1044",
				"reg_cpf" => "858.455.147-00",
				"reg_cep" => "48.970-000",
				"reg_uf" => "BA",
				"reg_cidade" => "Senhor do Bonfim",
				"reg_bairro" => "Águas Claras",
				"reg_endereco" => "Quadra f, Bloco 2, nª 01",
				"reg_email" => "elenicio@mail.com",
                "reg_senha" => password_hash("12345678", PASSWORD_DEFAULT),
				"status" => "ativo",
				"role" => "admin",
				
			],
			[
				"reg_nome" => "Gutembergue Nascimento",
				"reg_telefone" => "(74)9 6632-1044",
				"reg_cpf" => "471.125.147-00",
				"reg_cep" => "14.970-000",
				"reg_uf" => "BA",
				"reg_cidade" => "Jacobina",
				"reg_bairro" => "Monte Azul",
				"reg_endereco" => "Quadra f, Bloco 2, nª 01",
				"reg_email" => "gutembergue@mail.com",
                "reg_senha" => password_hash("101010", PASSWORD_DEFAULT),
				"status" => "ativo",
				"role" => "gestor",
            ],
            [
				"reg_nome" => "Layane Ribeiro",
				"reg_telefone" => "(74)9 8854-1010",
				"reg_cpf" => "478.000.123-00",
				"reg_cep" => "48.855-000",
				"reg_uf" => "BA",
				"reg_cidade" => "Salvador",
				"reg_bairro" => "Belo Rios Claras",
				"reg_endereco" => "Quadra f, Bloco 2, nª 01",
				"reg_email" => "laiane@mail.com",
                "reg_senha" => password_hash("987654123", PASSWORD_DEFAULT),
				"status" => "ativo",
				"role" => "user",
			]
		]);
    }
}
