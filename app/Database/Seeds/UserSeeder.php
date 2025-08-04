<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'       => 'Administrator',
                'email'      => 'admin@gmail.com',
                'password'   => password_hash('123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Kepala Sekolah',
                'email'      => 'kepala@gmail.com',
                'password'   => password_hash('123', PASSWORD_DEFAULT),
                'role'       => 'kepala_sekolah',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Guru 1',
                'email'      => 'guru1@gmail.com',
                'password'   => password_hash('123', PASSWORD_DEFAULT),
                'role'       => 'guru',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Guru 2',
                'email'      => 'guru2@gmail.com',
                'password'   => password_hash('guru123', PASSWORD_DEFAULT),
                'role'       => 'guru',
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        // Insert all users
        $this->db->table('users')->insertBatch($users);
    }
}
