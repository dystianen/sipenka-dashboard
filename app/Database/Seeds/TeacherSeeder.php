<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 3,
                'education' => 'S1',
                'major' => 'Pendidikan Matematika',
                'institution' => 'Universitas Negeri Yogyakarta',
                'gender' => 'Laki-laki',
                'birth_place' => 'Yogyakarta',
                'birth_date' => '1985-06-15',
                'address' => 'Jl. Kaliurang No. 123',
                'phone_number' => '081234567890',
                'photo' => '/uploads/teachers/1754289002_756bb255bbe5d16c14d8.jpg',
                'status' => 'active',
            ],
            [
                'user_id' => 4,
                'education' => 'S2',
                'major' => 'Pendidikan Bahasa Inggris',
                'institution' => 'Universitas Indonesia',
                'gender' => 'Perempuan',
                'birth_place' => 'Jakarta',
                'birth_date' => '1990-08-20',
                'address' => 'Jl. Sudirman No. 45',
                'phone_number' => '081298765432',
                'photo' => '/uploads/teachers/1754289002_756bb255bbe5d16c14d8.jpg',
                'status' => 'active',
            ],
            [
                'user_id' => 5,
                'education' => 'S1',
                'major' => 'Pendidikan Fisika',
                'institution' => 'Universitas Gadjah Mada',
                'gender' => 'Laki-laki',
                'birth_place' => 'Magelang',
                'birth_date' => '1987-03-10',
                'address' => 'Jl. Solo Km. 5',
                'phone_number' => '081345678901',
                'photo' => '/uploads/teachers/1754289002_756bb255bbe5d16c14d8.jpg',
                'status' => 'on_leave',
            ],
            [
                'user_id' => 6,
                'education' => 'S1',
                'major' => 'Pendidikan Biologi',
                'institution' => 'Universitas Negeri Malang',
                'gender' => 'Perempuan',
                'birth_place' => 'Surabaya',
                'birth_date' => '1992-12-05',
                'address' => 'Jl. Diponegoro No. 12',
                'phone_number' => '081356789012',
                'photo' => '/uploads/teachers/1754289002_756bb255bbe5d16c14d8.jpg',
                'status' => 'inactive',
            ],
        ];

        // Insert batch
        $this->db->table('teachers')->insertBatch($data);
    }
}
