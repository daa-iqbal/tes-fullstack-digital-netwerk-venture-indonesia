<?php

use Illuminate\Database\Seeder;
use App\Models\SoalCategory;
use App\Models\SoalSubCategory;


class SoalCategoryAndSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        SoalCategory::truncate();
        SoalSubCategory::truncate();
        Schema::enableForeignKeyConstraints();
        $this->command->info('enabling foreignkeys check');
        $categories = [
            [
               'id'   => 1,
               'name' => 'Test Intelegensia Umum (Latihan 1)',
               'sub_categories' => [
                    [
                        'name' => 'ANALOGI DAN SILOGISME',
                    ],

                    [
                        'name' => 'ARITMATIKA SOSIAL',
                    ],

                    [
                        'name' => 'BANGUN DATAR DAN RUANG',
                    ],

                    [
                        'name' => 'DASAR TIU',
                    ],

                    [
                        'name' => 'DERET DAN PENGUKURAN',
                    ],

                    [
                        'name' => 'FIGURAL',
                    ],

                    [
                        'name' => 'FILLING SLOT',
                    ],

                    [
                        'name' => 'HIMPUNAN',
                    ],

                    [
                        'name' => 'JARAK, KECEPATAN DAN WAKTU',
                    ],

                    [
                        'name' => 'LOGIKA POSISI',
                    ],

                    [
                        'name' => 'PELUANG',
                    ],

                    [
                        'name' => 'PELUANG PERMUTASI KOMBINASI',
                    ],

                    [
                        'name' => 'PEMODELAN MATEMATIS',
                    ],

                    [
                        'name' => 'PENALARAN ANALITIK',
                    ],

                    [
                        'name' => 'PERBANDINGAN',
                    ],

                    [
                        'name' => 'PERHITUNGAN',
                    ],

                    [
                        'name' => 'SOAL CERITA',
                    ],

                    [
                        'name' => 'STATISTIK',
                    ],

                    [
                        'name' => 'Tanpa Kategori',
                    ],

               ],
            ],
            [
                'id'   => 2,
                'name' => 'Test Karakteristik Pribadi (Latihan 1)',
                'sub_categories'=>[
                    [
                        'name' => 'Jejaring Kerja',
                    ],

                    [
                        'name' => 'Pelayanan Publik',
                    ],

                    [
                        'name' => 'Profesionalisme',
                    ],

                    [
                        'name' => 'Radikalisme',
                    ],

                    [
                        'name' => 'Sosial Budaya',
                    ],

                    [
                        'name' => 'Tanpa Kategori',
                    ],

                    [
                        'name' => 'Teknologi Informasi',
                    ],


                ],
            ],
            [
                'id'   => 3,
                'name' => 'Test Wawasan Kebangsaan (Latihan 1)',
                'sub_categories' => [
                    [
                        'name' => 'BAHASA INDONESIA'
                    ],
                    [
                        'name' => 'BELA NEGARA'
                    ],
                    [
                        'name' => 'INTEGRITAS'
                    ],
                    [
                        'name' => 'LEMBAGA NEGARA'
                    ],
                    [
                        'name' => 'NASIONALISME'
                    ],
                    [
                        'name' => 'NKRI'
                    ],
                    [
                        'name' => 'PANCASILA'
                    ],
                    [
                        'name' => 'PENGAMALAN PANCASILA'
                    ],
                    [
                        'name' => 'PILAR NEGARA'
                    ],
                    [
                        'name' => 'Tanpa Kategori'
                    ],
                    [
                        'name' => 'UUD 1945'
                    ],
                ],

            ],
            [
                'id'   => 4,
                'name' => 'SKB Bidan (Latihan 1)',
                'sub_categories' => [
                    [
                        'name' => 'BERSALIN'
                    ],
                    [
                        'name' => 'HAMIL'
                    ],
                    [
                        'name' => 'KELUARGA BERENCANA'
                    ],
                    [
                        'name' => 'NIFAS'
                    ],
                    [
                        'name' => 'PERIMINOPAUSE'
                    ],
                    [
                        'name' => 'PRAKONSEPSI'
                    ],
                    [
                        'name' => 'REMAJA'
                    ],
                ],

            ],
            [
                'id'   => 5,
                'name' => 'Test Intelegensia Umum (Try Out 1)',
                'sub_categories' => [
                    [
                        'name' => 'ANALOGI DAN SILOGISME',
                    ],

                    [
                        'name' => 'ARITMATIKA SOSIAL',
                    ],

                    [
                        'name' => 'BANGUN DATAR DAN RUANG',
                    ],

                    [
                        'name' => 'DASAR TIU',
                    ],

                    [
                        'name' => 'DERET DAN PENGUKURAN',
                    ],

                    [
                        'name' => 'FIGURAL',
                    ],

                    [
                        'name' => 'FILLING SLOT',
                    ],

                    [
                        'name' => 'HIMPUNAN',
                    ],

                    [
                        'name' => 'JARAK, KECEPATAN DAN WAKTU',
                    ],

                    [
                        'name' => 'LOGIKA POSISI',
                    ],

                    [
                        'name' => 'PELUANG',
                    ],

                    [
                        'name' => 'PELUANG PERMUTASI KOMBINASI',
                    ],

                    [
                        'name' => 'PEMODELAN MATEMATIS',
                    ],

                    [
                        'name' => 'PENALARAN ANALITIK',
                    ],

                    [
                        'name' => 'PERBANDINGAN',
                    ],

                    [
                        'name' => 'PERHITUNGAN',
                    ],

                    [
                        'name' => 'SOAL CERITA',
                    ],

                    [
                        'name' => 'STATISTIK',
                    ],

                    [
                        'name' => 'Tanpa Kategori',
                    ],

               ],

             ],
             [
                 'id'   => 6,
                 'name' => 'Test Karakteristik Pribadi (Try Out 1)',
                 'sub_categories' => [
                    [
                        'name' => 'Jejaring Kerja',
                    ],

                    [
                        'name' => 'Pelayanan Publik',
                    ],

                    [
                        'name' => 'Profesionalisme',
                    ],

                    [
                        'name' => 'Radikalisme',
                    ],

                    [
                        'name' => 'Sosial Budaya',
                    ],

                    [
                        'name' => 'Tanpa Kategori',
                    ],

                    [
                        'name' => 'Teknologi Informasi',
                    ],
                 ],

             ],
             [
                 'id'   => 7,
                 'name' => 'Test Wawasan Kebangsaan (Try Out 1)',
                 'sub_categories' => [
                    [
                        'name' => 'BAHASA INDONESIA'
                    ],
                    [
                        'name' => 'BELA NEGARA'
                    ],
                    [
                        'name' => 'INTEGRITAS'
                    ],
                    [
                        'name' => 'LEMBAGA NEGARA'
                    ],
                    [
                        'name' => 'NASIONALISME'
                    ],
                    [
                        'name' => 'NKRI'
                    ],
                    [
                        'name' => 'PANCASILA'
                    ],
                    [
                        'name' => 'PENGAMALAN PANCASILA'
                    ],
                    [
                        'name' => 'PILAR NEGARA'
                    ],
                    [
                        'name' => 'Tanpa Kategori'
                    ],
                    [
                        'name' => 'UUD 1945'
                    ],
                ],

             ],
             [
                'id'   => 8,
                'name' => 'SKB Bidan (Try Out 1)',
                'sub_categories' => [
                    [
                        'name' => 'BERSALIN'
                    ],
                    [
                        'name' => 'HAMIL'
                    ],
                    [
                        'name' => 'KELUARGA BERENCANA'
                    ],
                    [
                        'name' => 'NIFAS'
                    ],
                    [
                        'name' => 'PERIMINOPAUSE'
                    ],
                    [
                        'name' => 'PRAKONSEPSI'
                    ],
                    [
                        'name' => 'REMAJA'
                    ],
                ],

             ],
        ];

        foreach ($categories as $key => $value) {
            $datetimeCategory = new DateTime();
            $createSoalCategory = SoalCategory::create([
                'id' =>  $value['id'],
                'name'=> $value['name'],
                'created_at' => $datetimeCategory->format('Y-m-d H:i:s')
            ]);
            foreach ($value['sub_categories'] as $keySub => $valueSub) {
                $datetimeSubCategory = new DateTime();
                $createSoalSubCategory = SoalSubCategory::create([
                    'soal_category_id'=>$createSoalCategory->id,
                    'name' => $valueSub['name'],
                    'created_at' => $datetimeSubCategory->format('Y-m-d H:i:s')
                ]);

            }
        }

    }
}
