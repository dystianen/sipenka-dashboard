<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAHPWeights extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ahp_weight_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ahp_result_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'criteria_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'weight' => [
                'type'       => 'DOUBLE',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);

        $this->forge->addKey('ahp_weight_id', true);
        $this->forge->addForeignKey('ahp_result_id', 'ahp_results', 'ahp_result_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ahp_weights');
    }

    public function down()
    {
        $this->forge->dropTable('ahp_weights');
    }
}
