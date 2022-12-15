<?php

namespace App\Repositories\Shops;

use App\Models\RepairShops;

class ShopsRepository implements ShopsInterface
{
    private RepairShops $repairShops;

    public function __construct(
        RepairShops $repairShops
    )
    {
        $this->repairShops = $repairShops;
    }

    /**
     * @param $id
     * @return array|bool[]
     */
    public function deleteShop($id)
    {
        try{

            $shop = $this->repairShops->find($id);
            $shop->status = 'deleted';
            $shop->save();

            return [
                'status' => true,
            ];

        } catch (\Exception $exception) {
            return [
                'status' => false,
                'msg'   => $exception->getMessage(),
                'code'  => 1001
            ];
        }
    }

    /**
     * @param $data
     * @return array|bool[]
     */
    public function createShop($data)
    {
        try{

            $shop = $this->repairShops->create( $data);

            return [
                'status' => true,
            ];

        } catch (\Exception $exception) {
            return [
                'status' => false,
                'msg'   => $exception->getMessage(),
                'code'  => 1001
            ];
        }
    }

    /**
     * @param $id
     * @param $data
     * @return array|bool[]
     */
    public function updateShop($id, $data)
    {
        try{

            $shop = $this->repairShops->find($id)->update( $data);

            return [
                    'status' => true,
                ];

        } catch (\Exception $exception) {
            return [
                'status' => false,
                'msg'   => $exception->getMessage(),
                'code'  => 1001
            ];
        }
    }

    /**
     * @param $id
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
     */
    public function getShopDetails($id)
    {
        try{
            if( $id){
                return $this->repairShops->with(['damage'])->find($id);
            }
            return null;

        } catch (\Exception $exception) {
            return [
                'status' => false,
                'msg'   => $exception->getMessage(),
                'code'  => 1001
            ];
        }
    }

    /**
     * Listing repair shops with pagination
     *
     * @return array
     */
    public function getAllShops()
    {
        try{

            $list = $this->repairShops->with(['damage'])->orderBy('id', 'desc')->paginate(10);

            return [
                'status' => true,
                'data'  => $list
            ];

        } catch (\Exception $exception) {
            return [
                'status' => false,
                'msg'   => $exception->getMessage(),
                'code'  => 1001
            ];
        }
    }


    /**
     * Select repair shops fro damage report after the approved by Admin
     *
     * @param $damage_id
     * @return mixed|void
     */
    public function findTheShops($damage_id)
    {
        //TODO   select Repair shop: need to apply correct logic
        return array_unique([
                $this->repairShops->all()->random()->id,
                $this->repairShops->all()->random()->id,
                $this->repairShops->all()->random()->id
            ]);
    }
}
