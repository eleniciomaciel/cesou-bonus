<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;
class PontosMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'point_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'point_usuario' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null'       => true,
            ],
            'point_pontos' => [
                'type'       => 'INT',
                'constraint' => '5',
                'null'       => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
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
        $this->forge->addKey('point_id', true);
        $this->forge->createTable('pontos');
    }

    public function down()
    {
        $this->forge->dropTable('pontos');
    }
}
