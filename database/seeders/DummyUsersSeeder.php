<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
            'name'=>'Mas Admin',
            'email'=>'admin@gmail.com',
            'role'=>'admin',
            'password'=>bcrypt('123456')
        ],[
            'name'=>'Mas Costumer',
            'email'=>'costumer@gmail.com',
            'role'=>'costumer',
            'password'=>bcrypt('123456') 
        ]
          
    ];

    foreach($userData as $key => $val) {
        User::create($val);
    }
    }
}
