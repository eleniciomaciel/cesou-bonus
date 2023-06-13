<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Lojas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'loja_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'loja_cnpj' => [
                'type'          => 'VARCHAR',
                'constraint'    => '18',
                'null'          => true,
            ],
            'loja_nome_empresarial' => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
                'null'          => true,
            ],
            'loja_email' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'unique'        => true,
                'null'          => true,
            ],
            'loja_area_tel' => [
                'type'          => 'CHAR',
                'constraint'    => '4',
                'null'          => true,
            ],
            'loja_telefone' => [
                'type'          => 'VARCHAR',
                'constraint'    => '10',
                'unique'        => true,
                'null'          => true,
            ],
            'loja_nome_fantasia' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'unique'        => true,
                'null'          => true,
            ],
            'loja_data_abertura' => [
                'type'          => 'DATE',
                'null'          => true,
            ],
            'loja_cep' => [
                'type'          => 'VARCHAR',
                'constraint'    => '10',
                'null'          => true,
            ],
            'loja_uf' => [
                'type'          => 'CHAR',
                'constraint'    => '2',
                'null'          => true,
            ],
            'loja_cidade' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'loja_bairro' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => true,
            ],
            'loja_endereco' => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
                'null'          => true,
            ],
            'loja_status_pontos' => [
                'type'              => 'ENUM',
                'constraint'        => ['Trocado', 'Pendente'],
                'default'           => 'Pendente',
            ],
            'loja_lojista_id' => [
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'created_at' => [
                'type'              => 'TIMESTAMP',
                'default'           => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'              => 'TIMESTAMP',
                'null'              => true,
            ],
            'deleted_at' => [
                'type'              => 'TIMESTAMP',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('loja_id', true);
        $this->forge->createTable('lojas');
    }

    public function down()
    {
        $this->forge->dropTable('lojas');
    }
}
