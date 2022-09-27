<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            // Cities
            [
                'name' => 'show all cities',
                'value'=>'cities.index',
                'group_by'=> 'cities'
            ],
            [
                'name' => 'create city',
                'value'=>'cities.create',
                'group_by'=> 'cities'
            ],
            [
                'name' => 'edit city',
                'value'=>'cities.edit',
                'group_by'=> 'cities'
            ],
            [
                'name' => 'delete city',
                'value'=>'cities.destroy',
                'group_by'=> 'cities'
            ],
            // Areas
            [
                'name' => 'show all areas',
                'value'=>'areas.index',
                'group_by'=> 'areas'
            ],
            [
                'name' => 'create area',
                'value'=>'areas.create',
                'group_by'=> 'areas'
            ],
            [
                'name' => 'edit area',
                'value'=>'areas.edit',
                'group_by'=> 'areas'
            ],
            [
                'name' => 'delete area',
                'value'=>'areas.destroy',
                'group_by'=> 'areas'
            ],

            // Sellers
            [
                'name' => 'show all sellers',
                'value'=>'sellers.index',
                'group_by'=> 'sellers'
            ],
            [
                'name' => 'create seller',
                'value'=>'sellers.create',
                'group_by'=> 'sellers'
            ],
            [
                'name' => 'edit seller',
                'value'=>'sellers.edit',
                'group_by'=> 'sellers'
            ],
            [
                'name' => 'delete seller',
                'value'=>'sellers.destroy',
                'group_by'=> 'sellers'
            ],

            // Shippments
            [
                'name' => 'show all shippments',
                'value'=>'shippments.index',
                'group_by'=> 'shippments'
            ],
            [
                'name' => 'create shippment',
                'value'=>'shippments.create',
                'group_by'=> 'shippments'
            ],
            [
                'name' => 'edit shippment',
                'value'=>'shippments.edit',
                'group_by'=> 'shippments'
            ],
            [
                'name' => 'delete shippment',
                'value'=>'shippments.destroy',
                'group_by'=> 'shippments'
            ],
            [
                'name' => 'show shippment',
                'value'=>'shippments.show',
                'group_by'=> 'shippments'
            ],

            // Pickups
            [
                'name' => 'show assigned pickups',
                'value'=>'assigned_pickups.index',
                'group_by'=> 'assigned pickups'
            ],
            [
                'name' => 'assign pickup',
                'value'=>'assigned_pickups.assign',
                'group_by'=> 'assigned pickups'
            ],

            // Roles
            [
                'name' => 'show all roles',
                'value'=>'roles.index',
                'group_by'=> 'roles'
            ],
            [
                'name' => 'create role',
                'value'=>'roles.create',
                'group_by'=> 'roles'
            ],
            [
                'name' => 'edit role',
                'value'=>'roles.edit',
                'group_by'=> 'roles'
            ],
            [
                'name' => 'delete role',
                'value'=>'roles.destroy',
                'group_by'=> 'roles'
            ],

            // Roles
            [
                'name' => 'show all drivers',
                'value'=>'drivers.index',
                'group_by'=> 'drivers'
            ],
            [
                'name' => 'create driver',
                'value'=>'drivers.create',
                'group_by'=> 'drivers'
            ],
            [
                'name' => 'edit driver',
                'value'=>'drivers.edit',
                'group_by'=> 'drivers'
            ],
            [
                'name' => 'delete driver',
                'value'=>'drivers.destroy',
                'group_by'=> 'drivers'
            ],

            // Employees
            [
                'name' => 'show all employees',
                'value'=>'employees.index',
                'group_by'=> 'employees'
            ],
            [
                'name' => 'create employees',
                'value'=>'employees.create',
                'group_by'=> 'employees'
            ],
            [
                'name' => 'edit employees',
                'value'=>'employees.edit',
                'group_by'=> 'employees'
            ],
            [
                'name' => 'delete employees',
                'value'=>'employees.destroy',
                'group_by'=> 'employees'
            ],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

    }
}
