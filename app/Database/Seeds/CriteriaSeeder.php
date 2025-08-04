<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'code'        => 'C1',
                'name'        => 'Kedisiplinan',
                'type'        => 'benefit',
                'weight'      => 0.25,
                'description' => 'Menilai tingkat kedisiplinan guru dalam mengajar',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'code'        => 'C2',
                'name'        => 'Kompetensi Pedagogik',
                'type'        => 'benefit',
                'weight'      => 0.30,
                'description' => 'Kemampuan mengelola pembelajaran',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'code'        => 'C3',
                'name'        => 'Kompetensi Profesional',
                'type'        => 'benefit',
                'weight'      => 0.20,
                'description' => 'Penguasaan materi pembelajaran',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'code'        => 'C4',
                'name'        => 'Komunikasi',
                'type'        => 'benefit',
                'weight'      => 0.15,
                'description' => 'Kemampuan berkomunikasi dengan siswa dan rekan kerja',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'code'        => 'C5',
                'name'        => 'Tanggung Jawab',
                'type'        => 'benefit',
                'weight'      => 0.10,
                'description' => 'Komitmen terhadap tugas dan tanggung jawab',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('criteria')->insertBatch($data);
    }
}
