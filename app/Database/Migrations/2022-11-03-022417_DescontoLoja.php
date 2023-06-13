<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class DescontoLoja extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'dl_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'dl_loja_id' => [
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'dl_cliente_id' => [
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'dl_chave_cefaz' => [
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'unique'            => true,
            ],
            'dl_valor_venda' => [
                'type'              => 'DECIMAL',
                'constraint'        => '10,2',
                'unique'            => true,
            ],
            'dl_total_desconto' => [
                'type'              => 'FLOAT',
                'constraint'        => '10,2',
                'unique'            => true,
            ],
            'dl_valor_desconto' => [
                'type'              => 'VARCHAR',
                'constraint'        => '10,2',
                'unique'            => true,
            ],
            'dl_data' => [
                'type'          => 'DATE',
                'null'          => true,
            ],
            'dl_pontos' => [
                'type'              => 'INT',
                'constraint'        => '3',
                'null'              => true,
            ],
            'status_pontos' => [
                'type'              => 'ENUM',
                'constraint'        => ['Trocado', 'Pendente'],
                'default'           => 'Pendente',
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
        $this->forge->addKey('dl_id', true);
        $this->forge->createTable('descontolojas');
    }

    public function down()
    {
        $this->forge->dropTable('descontolojas');
    }
}
