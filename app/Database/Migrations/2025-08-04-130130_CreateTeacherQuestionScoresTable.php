<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeacherQuestionScoresTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'score_id'   => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'unsigned' => true],
            'teacher_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'period_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'question_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'score'      => ['type' => 'FLOAT'],
            'given_by'   => ['type' => 'INT', 'unsigned' => true],
            'notes'      => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('score_id', true);
        $this->forge->addForeignKey('teacher_id', 'teachers', 'teacher_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('period_id', 'periods', 'period_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('question_id', 'questions', 'question_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('given_by', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('teacher_question_scores');
    }

    public function down()
    {
        $this->forge->dropTable('teacher_question_scores');
    }
}
