<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use App\Models\product;

class ProductSeeder extends Seeder
{
    
    public function run()
    {
        $faker = faker::create();
        for ($i=0; $i < 100; $i++) { 
            $product = new Product();
            $product->title = $faker->name;
            
            $product->save();
        }

    }
}
