<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEvaluationResultsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'evaluation_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'teacher_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'ahp_result_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'period_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'rank' => [
                'type' => 'INT',
                'constraint' => 100
            ],
            'final_score' => [
                'type' => 'FLOAT'
            ],
            'normalized_score' => [
                'type' => 'FLOAT'
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 50
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
        $this->forge->addKey('evaluation_id', true);
        $this->forge->addForeignKey('teacher_id', 'teachers', 'teacher_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('ahp_result_id', 'ahp_results', 'ahp_result_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('period_id', 'periods', 'period_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('evaluation_results');
    }

    public function down()
    {
        $this->forge->dropTable('evaluation_results');
    }
}
