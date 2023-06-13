<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;
class CuponsParaDoacao extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cd_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'cd_qrcode_cupom' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cd_key_cupom' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'cd_data_cupom' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'cd_valor_cupom' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'cd_cnpj_cupom' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'cd_empresa_vendedora_cupom' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'cd_data_vencimento_cupom' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'cd_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Ativo', 'Compensado'],
                'default'    => 'Ativo',
            ],
            'cd_pontos' => [
                'type'       => 'INT',
                'constraint' =>  3,
                'default'    => '1',
                'null'       => true,
            ],
            'cd_usuario_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
            'cd_doador_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
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
        $this->forge->addKey('cd_id', true);
        $this->forge->createTable('cuponsdoacoes');
    }

    public function down()
    {
        $this->forge->dropTable('cuponsdoacoes');
    }
}
