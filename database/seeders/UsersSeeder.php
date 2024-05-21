<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as faker; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = faker::create();
        for ($i=0; $i < 5; $i++) { 
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = Hash::make(12345678);
            $user->save();            
        }
    }
}
