<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class BradescoExpress extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'brad_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'brad_cliente_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
            'brad_date' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'brad_time' => [
                'type'       => 'TIME',
                'null'       => true,
            ],
            'brad_date_time' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
            'brad_date_time_atendimento' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Aguardando', 'Cancelado', 'Atendido'],
                'default'    => 'Aguardando',
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
        $this->forge->addKey('brad_id', true);
        $this->forge->addForeignKey('brad_cliente_id', 'acesso_login', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bradescoexpresses');
    }

    public function down()
    {
        $this->forge->dropTable('bradescoexpresses');
    }
}
