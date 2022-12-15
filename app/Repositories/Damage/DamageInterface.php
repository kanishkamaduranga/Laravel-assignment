<?php

namespace App\Repositories\Damage;

interface DamageInterface
{

    /** return all damage reports
     * @return mixed
     */
    public function getAll( $customer_reference = null);

    /**
     *  Get damage details by ID
     *
     * @param $id
     * @return mixed
     */
    public function getDamage($id);


    /**
     * Save damage record
     *
     * @param $request
     * @return mixed
     */
    public function saveDamage($request);


    /**
     * Update existing damage report
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateDamage($request, $id);

    /**
     * Get damage report data count
     *
     * @param $status
     * @return mixed
     */
    public function getDamagesCount($status = null);

    /**
     * Update damage report status ( Rejected / Approved / etc... )
     *
     * @param $id
     * @param $status
     * @return mixed
     */
    public function updateDamageStatus($id, $status);

    /**
     * Assign repair shops to damage report
     *
     * @param $id
     * @param $repair_shop_ids
     * @return mixed
     */
    public function addRepairShops($id, $repair_shop_ids );
}
