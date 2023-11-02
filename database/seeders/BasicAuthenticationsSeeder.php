<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Schema;
use DB;



class BasicAuthenticationsSeeder extends Seeder
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
        $this->command->info('truncating permission_role...');
        DB::table('permission_role')->truncate();
        $this->command->info('truncating permission_user...');
        DB::table('permission_user')->truncate();
        $this->command->info('truncating user...');
        DB::table('users')->truncate();
        $this->command->info('truncating roles...');
        DB::table('roles')->truncate();
        $this->command->info('truncating permissions...');
        DB::table('permissions')->truncate();
        $this->command->info('truncating role_user...');
        DB::table('role_user')->truncate();
        $this->command->info('enabling foreignkeys check');
        Schema::enableForeignKeyConstraints();
        $builtInPermissions = [
            ['name' => 'kelolapengguna'],
            ['name' => 'kelolapengguna-pengguna'],
            ['name' => 'kelolapengguna-peran'],
            ['name' => 'kelolapengguna-hakakses'],
            //['name' => 'kelola-pendaftar-kbih']
        ];
        $builtInRolesAndUsers = [
            'super-admin' => [
                'name' => 'super-admin',
                //'built_in' => 1,
                'permissions' => [
                    'kelolapengguna',
                    'kelolapengguna-pengguna',
                    'kelolapengguna-peran',
                    'kelolapengguna-hakakses',
                ],
                'user' => [
                    [
                        'name' => 'Super Admin',
                        'email' => 'super.admin@asncbt.id',
                        'phone' => '001',
                        'password' => 'bismillah',
                        'is_active' => 1,
                        'built_in' => 1,
                    ],
                ],
            ],
            'admin' => [
                'name' => 'admin-all',
                //'built_in' => 0,
                'permissions' => [
                    
                ],
                'user' => [
                    [
                        'name' => 'Admin ASN CBT',
                        'email' => 'admin@asncbt.id',
                        'phone' => '08123456',
                        'password' => 'bismillah',
                        'is_active' => 1,
                        'built_in' => 0,
                    ],
                ],
            ],
            
            'learner' => [
                'name' => 'learner',
                //'built_in' => 0,
                'permissions' => [
                    //'kelola-pendaftar-kbih',
                ],
                'user' => [
                     [
                        'name' => 'Learner 1',
                        'email' => 'learner1@asncbt.id',
                        'phone' => '0811',
                        'password' => 'bismillah',
                        'is_active' => 1,
                        'built_in' => 0,
                    ],
                    [
                        'name' => 'Learner 2',
                        'email' => 'learner2@asncbt.id',
                        'phone' => '0812',
                        'password' => 'bismillah',
                        'is_active' => 1,
                        'built_in' => 0,
                    ],
                ],
            ],
            'teacher' => [
                'name' => 'teacher',
                //'built_in' => 0,
                'permissions' => [
                    //'kelola-pendaftar-kbih',
                ],
                'user' => [
                     [
                        'name' => 'Teacher 1',
                        'email' => 'dokter1@virthost.id',
                        'phone' => '0821',
                        'password' => 'bismillah',
                        'is_active' => 1,
                        'built_in' => 0,
                    ],
                    [
                        'name' => 'Dokter 2',
                        'email' => 'dokter2@virthost.id',
                        'phone' => '0822',
                        'password' => 'bismillah',
                        'is_active' => 1,
                        'built_in' => 0,
                    ],
                ],
            ],
        ];

        // foreach ($builtInPermissions as $permission) {
        //     Permission::firstOrCreate([
        //         'name' => $permission['name'],
        //         'display_name' => ucwords(str_replace('-', ' ', $permission['name'])),
        //         'description' => ucwords(str_replace('-', ' ', $permission['name'])),
        //         //'built_in' => 1,
        //     ]);
        //     $this->command->info('Creating Permission: '. ucwords(str_replace('-', ' ', $permission['name'])));
        // }
        foreach ($builtInRolesAndUsers as $key => $role) {
            // $persistedRole = Role::create([
            //     'name' => $role['name'],
            //     'display_name' => ucwords(str_replace('-', ' ', $role['name'])),
            //     'description' => ucwords(str_replace('-', ' ', $role['name'])),
            //     //'built_in' => $role['built_in'],
            // ]);
            // $this->command->info('Creating Role: '. ucwords(str_replace('-', ' ', $key)).' with '.@count($role['permissions']).' permissions.');

            $permissions = [];
            // foreach ($role['permissions'] as $permissionName) {
            //     $permissions[] = Permission::where('name', $permissionName)->first();   
            // }
            // $persistedRole->attachPermissions($permissions);

            foreach ($role['user'] as $user) {
                $persistedUser = User::create($user);
                $this->command->info('Creating User: '. $user['name'].' ('.$user['email'].')');
                // $persistedUser->attachRole($persistedRole);
                // $this->command->info('Attach Role '. $persistedRole['display_name'] .' to User '. $user['name']);
            }
        }

    }
}
