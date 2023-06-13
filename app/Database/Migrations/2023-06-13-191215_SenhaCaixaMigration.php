<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SenhaCaixaMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'senha_caixa' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('senhacaixas');
    }

    public function down()
    {
        $this->forge->dropTable('senhacaixas');
    }
}
