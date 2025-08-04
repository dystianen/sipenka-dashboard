<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeacherScoresTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'score_id'   => [
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
            'criteria_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'period_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'score' => [
                'type' => 'FLOAT'
            ],
            'given_by' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'is_final' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'notes' => [
                'type' => 'TEXT',
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
        $this->forge->addKey('score_id', true);
        $this->forge->addForeignKey('teacher_id', 'teachers', 'teacher_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('criteria_id', 'criteria', 'criteria_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('period_id', 'periods', 'period_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('given_by', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('teacher_scores');
    }

    public function down()
    {
        $this->forge->dropTable('teacher_scores');
    }
}
