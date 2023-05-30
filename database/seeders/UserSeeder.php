<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = [
            'fullname' => 'admin',
            'email' => 'admin21@gmail.com',
            'password' => Hash::make('admin')
        ];
        $admin =User::create($user1);
        $admin->assignRole('admin');

        $user2 = [
            'fullname' => 'customer',
            'email' => 'customer21@gmail.com',
            'password' => Hash::make('customer')
        ];
       $customer= User::create($user2);
       $customer->assignRole('customer');
    }
}
