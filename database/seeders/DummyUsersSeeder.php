<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userdata = [
            [
                'name'=> 'Fajar Adhitia',
                'email'=>'fajar@gmail.com',
                'role'=>'staff',
                'password' =>bcrypt('12345678')
            ],

            [
                'name'=> ' Pak Fajar Adhitia',
                'email'=>'fajar1@gmail.com',
                'role'=>'kepalalab',
                'password' =>bcrypt('12345678')
            ],

        ];

        foreach($userdata as $key => $val){
            User::create($val);
        }
    }
}
