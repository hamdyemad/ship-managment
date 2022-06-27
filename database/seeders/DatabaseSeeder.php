<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


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

        // User::create([
        //     'name' => 'user',
        //     'email' => 'user@app.com',
        //     'phone' => '999999999',
        //     'password' => Hash::make(12345),
        //     'special_pickup' => '10',
        // ]);

        $user = new User();
        $user->name = 'user';
        $user->email = 'user1@shipexeg.com';
        $user->phone = '999999999';
        $user->password = Hash::make(12345);
        $user->special_pickup = '10';
        $isSaved = $user->save();
        $user->syncRoles(Role::findById(3, 'web'));

        /* ****** web ****** */
        $admin = new Admin();
        $admin->name = 'admin';
        $admin->email = 'admin1@shipexeg.com';
        $admin->phone = '999999999';
        $admin->gender = 'male';
        $admin->dofbirth = date('Y-m-d H:i:s');;
        $admin->password = Hash::make(12345);
        $isSaved = $admin->save();
        $admin->syncRoles(Role::findById(1, 'admin'));
    }
}
