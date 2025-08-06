<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeriodSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'       => 'Semester Genap 2024',
                'start_date' => '2024-01-01',
                'end_date'   => '2024-06-30',
                'is_active'  => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Semester Ganjil 2024',
                'start_date' => '2024-07-01',
                'end_date'   => '2024-12-31',
                'is_active'  => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Semester Genap 2025',
                'start_date' => '2024-01-01',
                'end_date'   => '2024-06-30',
                'is_active'  => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Semester Ganjil 2025',
                'start_date' => '2024-07-01',
                'end_date'   => '2024-12-31',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('periods')->insertBatch($data);
    }
}
