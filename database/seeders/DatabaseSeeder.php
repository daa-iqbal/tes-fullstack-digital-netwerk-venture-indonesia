<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(BasicAuthenticationsSeeder::class);
        $this->call(FileTypesSeeder::class);
        $this->call(ConfirmationTypeSeeder::class);
        $this->call(NotifikasiActionSeeder::class);
        $this->call(NotifikasiGroupSeeder::class);
        $this->call(ProvinsiKotaSeeder::class);
        
    }
}
