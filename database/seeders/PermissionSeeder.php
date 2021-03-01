<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                'name' => 'read-dashboard',
                'guard_name' => 'web',
            ],
            [
                'name' => 'read-roles',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create-roles',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update-roles',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-roles',
                'guard_name' => 'web'
            ],
            [
                'name' => 'read-permissions',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create-permissions',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update-permissions',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-permissions',
                'guard_name' => 'web'
            ],
        ]);
    }
}
