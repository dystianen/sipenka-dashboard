<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCriteriaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'criteria_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'unique' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['benefit', 'cost'],
                'default' => 'benefit',
            ],
            'weight' => [
                'type' => 'FLOAT',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('criteria_id', true);
        $this->forge->createTable('criteria');
    }

    public function down()
    {
        $this->forge->dropTable('criteria');
    }
}
