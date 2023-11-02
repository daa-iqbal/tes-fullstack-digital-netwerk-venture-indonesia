<?php

use Illuminate\Database\Seeder;
use App\Models\MateriCategory;
use Carbon\Carbon;


class MateriCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('disabling foreignkeys check');
        Schema::disableForeignKeyConstraints();
        $this->command->info('truncating materi_categories');
        DB::table('materi_categories')->truncate();
        $datas = [
            [
                'id'   =>1,
                'name' => 'TWK'
            ],
            [
                'id'   =>2,
                'name' => 'TIU'
            ],
            [
                'id'   =>3,
                'name' => 'TKP'
            ],
            [
                'id'   =>4,
                'name' => 'Sesi Zoom'
            ],
            [
                'id'   =>5,
                'name' => 'Tips dan Trik'
            ]
        ];
        foreach ($datas as $key => $data) {
            $createdData = MateriCategory::create($data);
            $this->command->info("Creating Materi Kategori: "."'".ucwords($data['name'])."'");
        }



    }
}
