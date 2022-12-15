<?php

namespace Database\Seeders;

use App\Models\RepairShops;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepairShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // RepairShops::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            RepairShops::create([
                'name'      => $faker->streetName(),
                'email'     =>$faker->email,
                'tp'        => $faker->phoneNumber,
                'latitude'  =>$faker->randomFloat(6, 1, 50),
                'longitude' =>$faker->randomFloat(6, 1, 50),
            ]);
        }
    }
}
