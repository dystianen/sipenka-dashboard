<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuestionSubcategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'subcategory_id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'unsigned' => true],
            'category_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'name'           => ['type' => 'VARCHAR', 'constraint' => 100],
            'description'    => ['type' => 'TEXT', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('subcategory_id', true);
        $this->forge->addForeignKey('category_id', 'question_categories', 'category_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('question_subcategories');
    }

    public function down()
    {
        $this->forge->dropTable('question_subcategories');
    }
}
