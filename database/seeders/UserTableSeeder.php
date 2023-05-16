<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('password')
            ],
            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'password'=>bcrypt('password')
            ],
            [
                'name'=>'Super',
                'email'=>'super@gmail.com',
                'password'=>bcrypt('password')
            ],

        ];
        foreach ($users as  $user) {
            User::create($user);
        }
    }
}
