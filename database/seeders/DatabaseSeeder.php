<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(UsersTableSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(RepairShopsSeeder::class);
        $this->call(DamagesTableSeeder::class);
        $this->call(ImageSeeder::class);
    }
}
