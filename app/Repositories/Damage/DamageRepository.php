<?php

namespace App\Repositories\Damage;

use App\Models\Damage;


class DamageRepository implements DamageInterface
{

    private Damage $damage; // damage model

    public function __construct(
        Damage $damage
    )
    {
        $this->damage = $damage;
    }

    /**
     * update existing damage report
     *
     * @param $request
     * @param $id
     * @return array
     */
    public function updateDamage($request, $id)
    {
        try {
            $request_data = $request->all();
            $damage = $this->damage->find( $id);
            $damage->update( $request_data);

            return [
                'status' => true,
                'data'  => $damage,
                'damage_id' => $damage->id
            ];

        } catch (\Exception $exception){

            return [
                'status' => false,
                'msg'   => $exception->getMessage(),
                'code'  => 1001
            ];
        }
    }
    /**
     * Save damage record
     *
     * @param $request
     * @return array
     */
    public function saveDamage($request)
    {
        try {

            $request_data = $request->all();

            $damage = $this->damage->create([
                'description'   => $request_data['description'],
                'customer_reference'   => $request_data['customer_reference'],
                'latitude'      => $request_data['latitude'],
                'longitude'     => $request_data['longitude'],
            ]);
            return [
                'status' => true,
                'data'  => $damage,
                'damage_id' => $damage->id
            ];
        } catch (\Exception $exception){

            return [
                'status' => false,
                'msg'   => $exception->getMessage(),
                'code'  => 1001
            ];
        }
    }

    /**
     * Get damage details by ID
     *
     * @param $id
     * @return array
     */
    public function getDamage($id)
    {
        try {

            $data = $this->damage->with('customer', 'media', 'repairshop')->find( $id);

            return [
                'status' => true,
                'data'  => $data
            ];

        } catch (\Exception $exception){

            return [
                'status' => false,
                'msg'   => $exception->getMessage(),
                'code'  => 1001
            ];
        }
    }

    /**
     * return all damage reports data with pagination
     *
     * @return array
     */
    public function getAll( $customer_reference = null)
    {
        try {

            if($customer_reference) {
                $list = $this->damage->with(['media', 'customer', 'repairshop'])->where('customer_reference', $customer_reference )->orderBy('id', 'desc')->paginate(10);
            } else {
                $list = $this->damage->with(['media', 'customer', 'repairshop'])->orderBy('id', 'desc')->paginate(10);
            }

            return [
                'status' => true,
                'data'  => $list
            ];

        } catch (\Exception $exception){

            return [
                'status' => false,
                'msg'   => $exception->getMessage(),
                'code'  => 1001
            ];
        }
    }

    /**
     * Get damage report data count
     *
     * @param $status
     * @return void
     */
    public function getDamagesCount($status = null)
    {
        if( $status){
            return $this->damage->where('status', $status)->count();
        }else{
            return $this->damage->count();
        }
    }

    /**
     * Update damage report status ( Rejected / Approved / etc... )
     *
     * @param $id
     * @param $status
     * @return mixed|void
     */
    public function updateDamageStatus($id, $status)
    {
        return $this->damage->where('id', $id)->update([
            'status' => $status
        ]);
    }

    /**
     * assign repair shops to damage report
     *
     * @param $id
     * @param $repair_shop_ids
     * @return mixed|void
     */
    public function addRepairShops($id, $repair_shop_ids )
    {
        return $this->damage->find($id)->repairshop()->sync($repair_shop_ids);
    }
}
