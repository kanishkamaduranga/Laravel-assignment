<?php

namespace App\Repositories\Shops;

interface ShopsInterface
{

    /**
     * @param $id
     * @return mixed
     */
    public function deleteShop($id);

    /**
     * @param $data
     * @return mixed
     */
    public function createShop($data);
    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateShop($id, $data);

    /**
     * Select repair shops fro damage report after the approved by Admin
     *
     * @param $damage_id
     * @return mixed
     */
    public function findTheShops($damage_id);

    /**
     *  Listing repair shops with pagination
     *
     * @return array
     */
    public function getAllShops();

    /**
     * @param $id
     * @return mixed
     */
    public function getShopDetails($id);
}
