<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'bader',
            'email' => 'bader@app.com',
            'gender' => 'male',
            'dofbirth' => '12\12\20',
            'phone' => '999999999',
            'password' => Hash::make(12345),
        ]);
    }
}
