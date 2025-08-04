<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePairwiseComparisonsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'comparison_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'period_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'criteria_id_1' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'criteria_id_2' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'comparison_value' => [
                'type' => 'FLOAT',
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
                'null' => true,
            ],
        ]);

        $this->forge->addKey('comparison_id', true);
        $this->forge->addForeignKey('period_id', 'periods', 'period_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('criteria_id_1', 'question_categories', 'category_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('criteria_id_2', 'question_categories', 'category_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pairwise_comparisons');
    }

    public function down()
    {
        $this->forge->dropTable('pairwise_comparisons');
    }
}
