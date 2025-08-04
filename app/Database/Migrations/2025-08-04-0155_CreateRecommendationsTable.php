<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecommendationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'recommmendation_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'teacher_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'evaluator_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'period_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'content'    => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'deleted_at'  => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('recommmendation_id', true);
        $this->forge->addForeignKey('teacher_id', 'teachers', 'teacher_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('evaluator_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('period_id', 'periods', 'period_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('recommendations');
    }

    public function down()
    {
        $this->forge->dropTable('recommendations');
    }
}
