<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerPostRequest;
use App\Service\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends ApiController
{
    /** Manage all logic related customers
     * @var CustomerService
     */
    private CustomerService $customerService;

    public function __construct(
        CustomerService $customerService
    )
    {
        $this->customerService = $customerService;
    }


    /**
     * Store customers details
     * - "customer_reference" is the key value for identifying customer records in this system and third parties
     * - name / email / tp / etc ...
     *
     * @param CustomerPostRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function store(CustomerPostRequest $request)
    {
        try{

            return $this->customerService->saveCustomer( $request);

        } catch (\Exception $exception){
            return $this->returnError( 1001, $exception->getMessage());
        }
    }
}
