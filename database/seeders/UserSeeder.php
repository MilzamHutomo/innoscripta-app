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
        $data = [
            [
                'name' => 'Super Admin',
                'email' => 'super.admin@innoscripta.com',
                'password' => Hash::make('superadmin'),
                'role' => User::TYPE_ADMIN
            ],
            [
                'name' => 'Manager 1',
                'email' => 'a.manager@innoscripta.com',
                'password' => Hash::make('manager'),
                'role' => User::TYPE_MANAGER
            ],
            [
                'name' => 'Manager 2',
                'email' => 'b.manager@innoscripta.com',
                'password' => Hash::make('manager'),
                'role' => User::TYPE_MANAGER
            ],
            [
                'name' => 'Representative 1',
                'email' => 'a.representative@innoscripta.com',
                'password' => Hash::make('representative'),
                'role' => User::TYPE_REPRESENTATIVE
            ],
            [
                'name' => 'Representative 2',
                'email' => 'b.representative@innoscripta.com',
                'password' => Hash::make('representative'),
                'role' => User::TYPE_REPRESENTATIVE
            ],
            [
                'name' => 'Representative 3',
                'email' => 'c.representative@innoscripta.com',
                'password' => Hash::make('representative'),
                'role' => User::TYPE_REPRESENTATIVE
            ],
        ];

        for ($i=0; $i < count($data); $i++) { 
            User::create($data[$i]);
        }
    }
}
