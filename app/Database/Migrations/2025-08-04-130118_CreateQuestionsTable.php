<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'question_id'   => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'unsigned' => true],
            'category_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'subcategory_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'question_text' => ['type' => 'TEXT'],
            'scoring_type'  => ['type' => 'ENUM', 'constraint' => ['scale_1_4', 'scale_1_3', 'boolean']],
            'weight'        => ['type' => 'FLOAT', 'default' => 1],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('question_id', true);
        $this->forge->addForeignKey('category_id', 'question_categories', 'category_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('subcategory_id', 'question_subcategories', 'subcategory_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('questions');
    }

    public function down()
    {
        $this->forge->dropTable('questions');
    }
}
