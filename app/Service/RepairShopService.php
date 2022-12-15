<?php

namespace App\Service;

use App\Repositories\Shops\ShopsInterface;

class RepairShopService
{

    private ShopsInterface $shops;

    public function __construct(
        ShopsInterface $shops
    )
    {
        $this->shops = $shops;
    }

    public function deleteShop($id)
    {
        return $this->shops->deleteShop( $id);
    }


    public function createShop( $data)
    {
        return $info = $this->shops->createShop( $data);
    }

    public function updateShop( $id, $data)
    {
        return $info = $this->shops->updateShop($id, $data);
    }

    /**
     * Call repository , Get specified  repair shop details by id
     * return shop details with status
     *
     * @param $id
     * @return mixed
     */
    public function getShopDetails($id)
    {
        $details  = $this->shops->getShopDetails($id);

        if(!$details){
            $details['status'] = false;
            $details['code'] = 1002; // add code information not available
        }

        return $details;
    }

    /**
     * Call Repository, get all repair shop listing
     * return listing all shops
     *
     * @return array
     */
    public function getAllShops()
    {
        $data = $this->shops->getAllShops();
        if($data['status']){
            if( !count($data['data'])) {
                $data['status'] = false;
                $data['code'] = 1002; // add code information not available
            }
        }
        return $data;
    }
}
