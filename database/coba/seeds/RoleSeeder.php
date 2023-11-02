<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();
        $statusPegawai = [
            ['id' => 1, 'name' => 'super-admin','display_name' => 'Super Admin','description'=>'Super Admin'],
            ['id' => 2, 'name' => 'admin-all','display_name' => 'Admin All','description'=>'Admin All'],
            ['id' => 3, 'name' => 'learner','display_name' => 'Learner','description'=>'Learner'],
            ['id' => 4, 'name' => 'admin-cs','display_name' => 'Admin CS','description'=>'Admin CS'],
            ['id' => 5, 'name' => 'admin-pembayaran','display_name' => 'Admin Pembayaran','description'=>'Admin Pembayaran'],
            ['id' => 6, 'name' => 'teacher','display_name' => 'Teacher','description'=>'Teacher'],
           
        ];
        foreach ($statusPegawai as $status) {
	        DB::table('roles')->insert(array_merge($status, [
                'created_at' => Carbon::now(),
            ]));
        }

    }
}
