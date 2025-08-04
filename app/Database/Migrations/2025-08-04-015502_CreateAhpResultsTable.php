<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAhpResultsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ahp_result_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'period_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'calculated_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'weights' => [
                'type' => 'JSON'
            ],
            'cr_value' => [
                'type' => 'FLOAT'
            ],
            'is_valid' => [
                'type' => 'BOOLEAN'
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
        $this->forge->addKey('ahp_result_id', true);
        $this->forge->addForeignKey('period_id', 'periods', 'period_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('calculated_by', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ahp_results');
    }

    public function down()
    {
        $this->forge->dropTable('ahp_results');
    }
}
