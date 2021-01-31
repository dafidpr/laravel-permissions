<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Dafid Prasetyo',
            'username' => 'dafidpr',
            'email' => 'dafid@webmediadigital.com',
            'password' => Hash::make('1234'),
            'block' => 'N',
            'phone_number' => '085736274637',
            'created_by' => '1',
            'updated_by' => '1',
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Dimas Anggara',
            'username' => 'dimass',
            'email' => 'dimas@webmediadigital.com',
            'password' =>Hash::make('1234'),
            'block' => 'N',
            'phone_number' => '088473647364',
            'created_by' => '1',
            'updated_by' => '1',
        ]);

        $user->assignRole('user');
    }
}
