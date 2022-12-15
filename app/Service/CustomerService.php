<?php

namespace App\Service;

use App\Repositories\Customer\CustomerInterface;

class CustomerService
{

    private CustomerInterface $customer;

    public function __construct(
        CustomerInterface $customer
    )
    {
        $this->customer = $customer;
    }

    /**
     * Save customer details
     *
     * @param $request
     * @return mixed
     */
    public function saveCustomer($request)
    {
        $customer_data = $this->customer->saveCustomer($request);
        if($customer_data['status']) {
            if ( !$customer_data['data'])  {
                $customer_data['status'] = false;
                $customer_data['code'] = 1002; // add code information not available
            }
        }

        return $customer_data;
    }
}
