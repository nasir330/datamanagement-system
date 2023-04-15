<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Members;
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
         //create variable and assign data
       $users = [
            [
                'type' => '2',
                'username' => 'admin1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('11112222'),           
                'status' => 'pending',               
            ],
            [
                'type' => '2',
                'username' => 'admin2',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('11112222'),           
                'status' => 'pending',               
            ],
            [
                'type' => '2',
                'username' => 'admin3',
                'email' => 'admin3@gmail.com',
                'password' => Hash::make('11112222'),           
                'status' => 'pending',               
            ],
            [
                'type' => '3',
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('11112222'),           
                'status' => 'pending',               
            ],
            [
                'type' => '3',
                'username' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('11112222'),           
                'status' => 'pending',               
            ],
            [
                'type' => '3',
                'username' => 'user3',
                'email' => 'user3@gmail.com',
                'password' => Hash::make('11112222'),           
                'status' => 'pending',               
            ],
            [
                'type' => '4',
                'username' => 'member1',
                'email' => 'member1@gmail.com',
                'password' => Hash::make('11112222'),           
                'status' => 'pending',               
            ],
            [
                'type' => '4',
                'username' => 'member2',
                'email' => 'member2@gmail.com',
                'password' => Hash::make('11112222'),           
                'status' => 'pending',               
            ],
            [
                'type' => '4',
                'username' => 'member3',
                'email' => 'member3@gmail.com',
                'password' => Hash::make('11112222'),           
                'status' => 'pending',               
            ]                               
        ];
        $userId= [
            ['userId' => '2'],
            ['userId' => '3'],
            ['userId' => '4'],
            ['userId' => '5'],
            ['userId' => '6'],
            ['userId' => '7'],
            ['userId' => '8'],
            ['userId' => '9'],
            ['userId' => '10']
        ];

        //create a loop to run multiple
        foreach($users as $key=> $user){
            User::create($user);               
        }        
        //create a loop to run multiple
        foreach($userId as $key=> $id){
            Members::create($id);               
        }        
    }
}
