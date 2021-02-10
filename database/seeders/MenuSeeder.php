<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::insert([
            [
                'parent'    => '0',
                'group'     => 'Backend',
                'title'     => 'Analytics Dashboard',
                'url'       => '/administrator/dashboard',
                'icon'      => 'icon ni ni-growth',
                'target'    => 'none',
                'position'  => '1',
                'created_by'=> '1',
                'updated_by'=> '1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'parent'    => '0',
                'group'     => 'Backend',
                'title'     => 'User Manager',
                'url'       => '#',
                'icon'      => 'icon ni ni-users',
                'target'    => 'none',
                'position'  => '2',
                'created_by'=> '1',
                'updated_by'=> '1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'parent'    => '2',
                'group'     => 'Backend',
                'title'     => 'Users',
                'url'       => '/administrator/users',
                'icon'      => '(NULL)',
                'target'    => 'none',
                'position'  => '3',
                'created_by'=> '1',
                'updated_by'=> '1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'parent'    => '2',
                'group'     => 'Backend',
                'title'     => 'Roles',
                'url'       => '/administrator/roles',
                'icon'      => '(NULL)',
                'target'    => 'none',
                'position'  => '4',
                'created_by'=> '1',
                'updated_by'=> '1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'parent'    => '0',
                'group'     => 'Backend',
                'title'     => 'Menu Manager',
                'url'       => '/administrator/menus',
                'icon'      => 'icon ni ni-grid-alt',
                'target'    => 'none',
                'position'  => '5',
                'created_by'=> '1',
                'updated_by'=> '1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'parent'    => '0',
                'group'     => 'Backend',
                'title'     => 'Permissions',
                'url'       => '/administrator/permissions',
                'icon'      => 'icon ni ni-security',
                'target'    => 'none',
                'position'  => '6',
                'created_by'=> '1',
                'updated_by'=> '1',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]
        ]);
    }
}
