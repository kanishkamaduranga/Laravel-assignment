<?php

namespace App\Repositories\Customer;

use App\Models\Customer;

class CustomerRepository implements CustomerInterface
{
    private Customer $customer;

    public function __construct(
        Customer $customer
    )
    {
        $this->customer = $customer;
    }

    /**
     * get customer details by Id not customer reference
     *
     * @param $id
     * @return mixed
     */
    public function getCustomer($id)
    {
        return $this->customer->find($id);
    }

    /**
     * saving customer details.
     *
     * @param $request
     * @return array
     */
    public function saveCustomer($request)
    {
        try{

            $request_data = $request->all();

            $customer = $this->customer->create([
                'customer_reference' => $request_data['customer_reference'],
                'name'      => $request_data['name'],
                'email'     => $request_data['email'],
                'tp'        => (isset($request_data['tp'])) ? $request_data['tp'] : null,
            ]);

            return [
                'status' => true,
                'data'  => $customer,
                'customer_id' => $customer->id
            ];

        } catch (\Exception $exception){

            return [
                'status' => false,
                'msg'   => $exception->getMessage(),
                'code'  => 1001
            ];
        }
    }
}
