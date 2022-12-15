<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Media::truncate();
        $damage_ids = DB::table('damages')->pluck('id');

        $faker = \Faker\Factory::create();

        foreach ($damage_ids as $damage_id){
            Media::create([
                'title' => 'ss.png',
                'path' => '/images/21/ss-62e0495b22858.png',
                'damages_id' => $damage_id
            ]);
            Media::create([
                'title' => 'ss.png',
                'path' => '/images/21/ss-62e0495b22858.png',
                'damages_id' => $damage_id
            ]);
        }
    }
}
