<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SoalCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('soal_categories')->truncate();
        Schema::enableForeignKeyConstraints();
        $soalCategory = [
            ['id' => 1, 'name' => 'TIU'],
            ['id' => 2, 'name' => 'TWK'],
            ['id' => 3, 'name' => 'TKP'],
           
           
        ];
        foreach ($soalCategory as $category) {
	        DB::table('soal_categories')->insert(array_merge($category, [
                'created_at' => Carbon::now(),
            ]));
        }
    }
}
