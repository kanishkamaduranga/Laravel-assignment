<?php

namespace Database\Seeders;

use App\Models\Damage;
use App\Service\DamageService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DamagesTableSeeder extends Seeder
{

    private DamageService $damageService;

    public function __construct(
        DamageService $damageService
    )
    {
        $this->damageService = $damageService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        ///Damage::truncate();
        $customer_references = DB::table('customers')->pluck('customer_reference');
        $shop_references = DB::table('repair_shops')->pluck('id');
        $faker = \Faker\Factory::create();

        $status_arra = ['pending','approved','rejected','deleted'];

        for ($i = 0; $i < 50; $i++) {

            $status = $faker->randomElement($status_arra);

            $damage_id = Damage::create([
                'description' => $faker->text,
                'customer_reference'=> $faker->randomElement($customer_references),
                'latitude'  =>  $faker->randomFloat(6, 1, 50),
                'longitude' =>  $faker->randomFloat(6, 1, 50),
                'status' => $status
            ])->id;

            $shop = null;
            if('approved' ==$status){ // assign repair shops to approved damages

                $this->damageService->afterDamageApprovalAssingShops( $damage_id);
            }
        }
    }
}
