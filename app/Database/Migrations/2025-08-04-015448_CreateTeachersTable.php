<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeachersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'teacher_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
            'education' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'major' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'institution' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'birth_place' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'birth_date' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive', 'on_leave']
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('teacher_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('teachers');
    }

    public function down()
    {
        $this->forge->dropTable('teachers');
    }
}
