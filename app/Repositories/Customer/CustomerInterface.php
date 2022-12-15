<?php

namespace App\Repositories\Customer;

interface CustomerInterface
{

    /** save customer details
     * @param $request
     * @return mixed
     */
    public function saveCustomer($request);

    /** get customer details by Id not customer reference
     * @param $id
     * @return mixed
     */
    public function getCustomer($id);

}
