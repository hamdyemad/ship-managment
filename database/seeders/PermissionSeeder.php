<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        /*  ****** admin ******  */
        // Permission::create(['name' => 'Create-Shippment', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Shippments', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Shippment', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Shippment', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Employee', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Employees', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Employee', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Employee', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Driver', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Drivers', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Driver', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Driver', 'guard_name' => 'admin']);
        /* ****** admin ****** */

        /* ****** employee ****** */
        Permission::create(['name' => 'Create-Shippment', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Shippments', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Shippment', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Shippment', 'guard_name' => 'employee']);

        Permission::create(['name' => 'Create-User', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Users', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-User', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-User', 'guard_name' => 'employee']);

        Permission::create(['name' => 'Create-Employee', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Employees', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Employee', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Employee', 'guard_name' => 'employee']);

        Permission::create(['name' => 'Create-Driver', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Read-Drivers', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Update-Driver', 'guard_name' => 'employee']);
        Permission::create(['name' => 'Delete-Driver', 'guard_name' => 'employee']);
        /* ****** employee ****** */

        /* ****** web ****** */
        Permission::create(['name' => 'Create-Pickup', 'guard_name' => 'web']);
        Permission::create(['name' => 'Read-Pickups', 'guard_name' => 'web']);
        Permission::create(['name' => 'Update-Pickup', 'guard_name' => 'web']);
        Permission::create(['name' => 'Delete-Pickup', 'guard_name' => 'web']);

        Permission::create(['name' => 'Create-Shippment', 'guard_name' => 'web']);
        Permission::create(['name' => 'Read-Shippments', 'guard_name' => 'web']);
        Permission::create(['name' => 'Update-Shippment', 'guard_name' => 'web']);
        Permission::create(['name' => 'Delete-Shippment', 'guard_name' => 'web']);
        /* ****** web ****** */
    }
}
