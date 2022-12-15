<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::truncate();

        $faker = \Faker\Factory::create();

        $ref_start = 5000;

        for ($i = 0; $i < 5; $i++) {
            Customer::create([
                'name'      => $faker->streetName(),
                'customer_reference' => ( $ref_start + $i ),
                'email'     => $faker->email,
                'tp'        => $faker->phoneNumber,
            ]);
        }
    }
}
