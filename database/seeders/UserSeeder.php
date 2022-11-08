<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'username' => 'teacher1',
                'password' => bcrypt('123456a@A'),
                'name' => 'Teacher 1',
                'email' => 'teacher1@gmail.com',
                'phone' => '0123456789',
                'role' => 0
            ],
            [
                'username' => 'teacher2',
                'password' => bcrypt('123456a@A'),
                'name' => 'Teacher 2',
                'email' => 'teacher2@gmail.com',
                'phone' => '0987654321',
                'role' => 0
            ]
        ];

        User::insert($data);
    }
}
