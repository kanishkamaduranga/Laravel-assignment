<?php

namespace Tests\Unit;

use App\Models\RepairShops;
use Tests\TestCase;

class RapairShopsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_if_seeders_works()
    {
        $this->seed();
    }

    public function test_delete_shops()
    {
        $shop = RepairShops::factory()->count(1)->make();
        $shop = RepairShops::first();

        if($shop){
            $shop->delete();
        }

        $this->assertTrue(true);
    }

    public function test_shops_duplication()
    {
        $shop1 = RepairShops::make([
            'name' => 'shop1',
            'email' => 'shop@email.com',
            'tp' => 0111314654,
            'latitude' => 1325646,
            'longitude' => 4876446
        ]);

        $shop2 = RepairShops::make([
            'name' => 'shop2',
            'email' => 'shop2@email.com',
            'tp' => 0112224654,
            'latitude' => 1322646,
            'longitude' => 4872446
        ]);

        $this->assertTrue($shop1->email != $shop2->email );
    }
}
