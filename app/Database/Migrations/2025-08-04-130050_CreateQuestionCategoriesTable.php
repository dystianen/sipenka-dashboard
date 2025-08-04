<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuestionCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'category_id'   => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'unsigned' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'description'   => ['type' => 'TEXT', 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('category_id', true);
        $this->forge->createTable('question_categories');
    }

    public function down()
    {
        $this->forge->dropTable('question_categories');
    }
}
