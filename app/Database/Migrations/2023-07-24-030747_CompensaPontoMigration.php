<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;
class CompensaPontoMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cp' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cliente_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'pontos' => [
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
        $this->forge->addKey('id_cp', true);
        $this->forge->addForeignKey('cliente_id', 'acesso_login', 'id');
        $this->forge->createTable('compensapontos');
    }

    public function down()
    {
        $this->forge->dropTable('compensapontos');
    }
}
