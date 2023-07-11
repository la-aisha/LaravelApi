<?php

namespace Database\Seeders;

/* ----importer----- */
use App\Models\User ;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/* ----a importer ----  */
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* --- 1 creer permission --- */
        $user_list = Permission::create(['name'=>'users.list']);
        $user_view = Permission::create(['name'=>'users.view']);
        $user_create = Permission::create(['name'=>'users.create']);
        $user_update = Permission::create(['name'=>'users.update']);
        $user_delete = Permission::create(['name'=>'users.delete']);

        /* --- 2 creer role pour admin  --- */
        $admin_role = Role::create(['name'=>'admin']);
        $admin_role->givePermissionTo([
            $user_create,
            $user_list ,
            $user_delete,
            $user_update,
            $user_view
        ]);

        /* ---3 creer admin--- */
        $admin  = User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=> bcrypt('password'),
            
        ]);

        /* --- assignRole et give permission */
        $admin->assignRole($admin_role);
        $admin->givePermissionTo([
            $user_create,
            $user_list ,
            $user_delete,
            $user_update,
            $user_view
        ]);

        /* ---3 creer admin--- */
        $user  = User::create([
            'name'=>'user',
            'email'=>'user@admin.com',
            'password'=> bcrypt('password'),
            
        ]);

        $user_role = Role::create(['name'=>'user']) ;

        /* --- assignRole et give permission */
        $user->assignRole($user_role);
        $user->givePermissionTo([
            $user_create,
            $user_delete,
            $user_update,
            $user_view
        ]);
        //dump($user->roles);
        dump($user->permissions);
        



    }
}
