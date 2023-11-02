<?php

use Illuminate\Database\Seeder;
use App\Models\MateriType;
use Carbon\Carbon;

class MateriTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->command->info('disabling foreignkeys check');
        Schema::disableForeignKeyConstraints();
        $this->command->info('materi_types');
        DB::table('materi_types')->truncate();
        $datas = [
            [
                'id'   =>1,
                'name' => 'Materi Video'
            ],
            [
                'id'   =>2,
                'name' => 'Materi Text'
            ],
            [
                'id'   =>3,
                'name' => 'Materi Ajar'
            ],

        ];
        foreach ($datas as $key => $data) {
            $createdData = MateriType::create($data);
            $this->command->info("Creating Materi Tipe: "."'".ucwords($data['name'])."'");
        }
    }
}
