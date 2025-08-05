<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Questions2Seeder extends Seeder
{
    public function run()
    {
        // ========== CATEGORY 2 ==========
        $this->db->table('question_categories')->insert([
            'name'        => 'Instrumen Penilaian Pelaksanaan Pembelajaran',
            'description' => 'Instrumen observasi pelaksanaan kegiatan belajar mengajar',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        ]);
        $categoryId2 = $this->db->insertID();

        $data2 = [
            'Aspek dan Motivasi' => [
                'Mengaitkan materi pembelajaran sekarang dengan pengalaman peserta didik atau pembelajaran sebelumnya',
                'Mengajukan pertanyaan menantang',
                'Menyampaikan manfaat materi pembelajaran',
                'Mendemonstrasikan sesuatu yang terkait dengan materi pembelajaran',
            ],
            'Pencapaian Kompetensi dan Rencana Kegiatan' => [
                'Menyampaikan kemampuan yang akan dicapai peserta didik',
                'Menyampaikan rencana kegiatan misalnya, individual, kerja kelompok, dan melakukan observasi',
            ],
            'Penguasaan Materi Pelajaran' => [
                'Kemampuan menyesuaikan materi dengan tujuan pembelajaran',
                'Kemampuan mengaitkan materi dengan pengetahuan lain yang relevan, perkembangan iptek, dan kehidupan nyata',
                'Menyampaikan pembahasan materi pembelajaran dengan tepat',
                'Menyampaikan materi secara sistematik (mudah ke sulit, dan dari konkret ke abstrak)',
            ],
            'Penerapan Strategi Pembelajaran yang Mendidik' => [
                'Melaksanakan pembelajaran yang sesuai dengan kompetensi yang akan dicapai',
                'Memfasilitasi kegiatan yang memuat komponen eksplorasi, elaborasi, dan konfirmasi',
                'Melaksanakan pembelajaran secara runtut',
                'Menguasai kelas',
                'Melaksanakan pembelajaran yang bersifat kontekstual',
                'Melaksanakan pembelajaran yang memungkinkan tumbuhnya kebiasaan positif (nuturent effect)',
                'Melaksanakan pembelajaran  sesuai dengan alokasi waktu yang direncanakan'
            ],
            'Penerapan Pendekatan Saintifik' => [
                'Memberikan pertanyaan mengapa dan bagaimana',
                'Memancing peserta didik untuk bertanya',
                'Memfasilitasi peserta didik untuk mencoba',
                'Memfasilitasi peserta didik untuk mengamati',
                'Memfasilitasi peserta didik untuk menganalisis',
                'Memberikan pertanyaan peserta didik untuk menalar (proses berfikir, yang logis dan sistematis)',
                'Menyediakan kegiatan peserta didik untuk menyimpulkan',
            ],
            'Pemanfaatan Sumber Belajar/Media dalam Pembelajaran' => [
                'Menunjukkan keterampilan dalam penggunaan sumber belajar/pembelajaran',
                'Menunjukkan keterampilan dalam penggunaan media pembelajaran',
                'Menghasilkan pesan yang menarik',
                'Melibatkan peserta didik dalam pemanfaatan sumber belajar pembelajaran',
                'Melibatkan peserta didik dalam pemanfaatan media pembelajaran',
            ],
            'Pelibatan Peserta Didik dalam Pembelajaran' => [
                'Menumbuhkan partisipasi aktif peserta didik melalui interaksi guru, peserta didik, sumber belajar',
                'Merespon positif partisipasi peserta didik',
                'Menunjukkan sikap terbuka terhadap respon peserta didik',
                'Menunjukkan hubungan antar pribadi yang kondusif',
                'Menumbuhkan keceriaan atau antusiasme peserta didik dalam belajar',
            ],
            'Penggunaan Bahasa yang Benar dan Tepat dalam Pembelajaran' => [
                'Menggunakan bahasa lisan secara jelas dan lancar',
                'Menggunakan bahasa tulis yang baik dan benar',
            ],
            'Penutup Pembelajaran' => [
                'Melakukan refleksi atau membuat rangkuman dengan melibatkan peserta didik',
                'Memberikan tes lisan atau tulisan',
                'Mengumpulkan hasil kerja sebagai bahan portofolio',
                'Melaksanakan tindak lanjut dengan memberikan arahan kegiatan berikutnya dan tugas pengayaan',
            ]
        ];

        foreach ($data2 as $subcatName => $questions2) {
            $this->db->table('question_subcategories')->insert([
                'category_id' => $categoryId2,
                'name'        => $subcatName,
                'description' => $subcatName,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ]);
            $subcategoryId2 = $this->db->insertID();

            foreach ($questions2 as $questionText) {
                $this->db->table('questions')->insert([
                    'category_id'    => $categoryId2,
                    'subcategory_id' => $subcategoryId2,
                    'question_text'  => $questionText,
                    'scoring_type'   => 'boolean',
                    'weight'         => 1.0,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
