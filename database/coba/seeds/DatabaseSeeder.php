<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(BasicAuthenticationsSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(FileTypesSeeder::class);
        $this->call(ConfirmationTypeSeeder::class);
        $this->call(MateriTypeSeeder::class);
        $this->call(MateriCategorySeeder::class);
        $this->call(NotifikasiActionSeeder::class);
        $this->call(NotifikasiGroupSeeder::class);
        $this->call(SoalCategoryAndSubCategorySeeder::class);

        // $this->call(UsersTableSeeder::class);
    }
}
