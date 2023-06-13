<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class LevaTraz extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'lvt_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'lvt_cliente_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
            'lvt_solicitante' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'lvt_tel_whats_app' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'lvt_date' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'lvt_time' => [
                'type'       => 'TIME',
                'null'       => true,
            ],
            'lvt_tel_dois' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null'       => true,
            ],
            'lvt_date_time' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
            'lvt_bairro' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'lvt_rua' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'lvt_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'lvt_status' => [
                'type'       => 'ENUM',
                'constraint' => ['Aguardando', 'Cancelado', 'Atendido', 'Confirmado'],
                'default'    => 'Aguardando',
            ],
            'lvt_colaborador_id' => [
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
        $this->forge->addKey('lvt_id', true);
        $this->forge->addForeignKey('lvt_cliente_id', 'acesso_login', 'id');
        $this->forge->addForeignKey('lvt_colaborador_id', 'acesso_login', 'id');
        $this->forge->createTable('leva_e_traz');
    }

    public function down()
    {
        $this->forge->dropTable('leva_e_traz');
    }
}
