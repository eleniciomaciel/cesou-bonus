<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CupomMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cup_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cup_qrcode_cupom' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cup_key_cupom' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'cup_data_cupom' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'cup_valor_cupom' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'cup_cnpj_cupom' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'cup_empresa_vendedora_cupom' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'cup_data_vencimento_cupom' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'cup_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Ativo', 'Compensado'],
                'default'    => 'Ativo',
            ],
            'cup_pontos' => [
                'type'       => 'INT',
                'constraint' =>  3,
                'default'    => '1',
                'null'       => true,
            ],
            'cup_usuario_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
            'cup_loja_do_desconto_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('cup_id', true);
        $this->forge->addForeignKey('cup_usuario_id', 'acesso_login', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cupom');
    }

    public function down()
    {
        $this->forge->dropTable('cupom');
    }
}
