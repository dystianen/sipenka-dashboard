<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    public function run()
    {
        // CATEGORY 1
        $this->db->table('question_categories')->insert([
            'name'        => 'Instrumen Perencanaan Kegiatan Pembelajaran',
            'description' => 'Instrumen evaluasi terhadap perencanaan pembelajaran oleh guru',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        ]);
        $categoryId = $this->db->insertID();

        // SUBCATEGORIES dan pertanyaan di dalamnya
        $data = [
            'Identitas Mata Pelajaran' => [
                'Terdapat: satuan pendidikan, kelas, semester, mata pelajaran atau tema pelajaran/sub tema, jumlah pertemuan',
            ],
            'Perumusan Indikator' => [
                'Kesesuaian dengan Kompetensi Dasar',
                'Kesesuaian penggunaan kata kerja operasional dengan kompetensi yang diukur',
                'Kesesuaian rumusan dengan aspek pengetahuan',
                'Kesesuaian rumusan dengan aspek keterampilan',
            ],
            'Perumusan Tujuan Pembelajaran' => [
                'Kesesuaian dengan indikator',
                'Kesesuaian perumusan dengan aspek Audience, Behaviour, Condition, dan Degree',
            ],
            'Pemilihan Materi Ajar' => [
                'Kesesuaian dengan tujuan pembelajaran',
                'Kesesuaian dengan karakteristik peserta didik',
                'Keruntutan uraian materi ajar',
            ],
            'Pemilihan Sumber Belajar' => [
                'Kesesuaian dengan Tujuan Pembelajaran',
                'Kesesuaian dengan peserta didik',
                'Kesesuaian dengan aspek saintifik',
                'Kesesuaian dengan karakteristik peserta didik',
            ],
            'Pemilihan Media  Belajar' => [
                'Kesesuaian dengan Tujuan Pembelajaran',
                'Kesesuaian dengan Materi Pembelajaran',
                'Kesesuaian dengan pendekatan saintifik',
                'Kesesuaian dengan karakteristik peserta didik',
            ],
            'Metode Pembelajaran' => [
                'Kesesuaian dengan tujuan Pembelajaran',
                'Kesesuaian dengan pendekatan saintifik',
                'Kesesuaian dengan karakteristik peserta didik',
            ],
            'Skenario Pembelajaran' => [
                'Menampilkan kegiatan pendahuluan, inti, dan penutup dengan jelas',
                'Kesesuaian kegiatan dengan pendekatan saintific (mengamati, menanya, mengumpulkan informasi mengasosiasikan informasi, mengkomunisasikan) ',
                'Kesesuaian dengan metode pembelajaran',
                'Kesesuaian kegiatan dengan sistematika materi',
                'Kesesuaian alokasi waktu kegiatan pendahuluan, kegiatan inti dan kegiatan penutup dengan cakupan materi'
            ],
            'Rencana Penilaian Otentik' => [
                'Kesesuaian bentuk, tekhnik dan instrument dengan indicator pencapaian kompetensi',
                'Kesesuaian antara bentuk, tekhnik dan instrument penilaian sikap',
                'Kesesuaian antara bentuk, tekhnik dan instrument penilaian Pengetahuan',
                'Kesesuaian antara bentuk, tekhnik dan instrument penilaian keterampilan'
            ]
        ];

        foreach ($data as $subcatName => $questions) {
            // Insert subcategory
            $this->db->table('question_subcategories')->insert([
                'category_id' => $categoryId,
                'name'        => $subcatName,
                'description' => $subcatName,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ]);
            $subcategoryId = $this->db->insertID();

            // Insert questions
            foreach ($questions as $questionText) {
                $this->db->table('questions')->insert([
                    'category_id'    => $categoryId,
                    'subcategory_id' => $subcategoryId,
                    'question_text'  => $questionText,
                    'scoring_type'   => 'scale_1_3',
                    'weight'         => 1.0,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
