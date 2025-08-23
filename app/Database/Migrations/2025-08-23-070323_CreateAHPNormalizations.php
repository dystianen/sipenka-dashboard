<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAHPNormalizations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ahp_normalization_id' => [
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
            'criteria_id_row' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'criteria_id_col' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'normalized_value' => [
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

        $this->forge->addKey('ahp_normalization_id', true);
        $this->forge->addForeignKey('ahp_result_id', 'ahp_results', 'ahp_result_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ahp_normalizations');
    }

    public function down()
    {
        $this->forge->dropTable('ahp_normalizations');
    }
}
