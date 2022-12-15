<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Damage\DamagePostRequest;
use App\Http\Requests\Damage\DamageUpdateRequest;
use App\Service\DamageService;
use Illuminate\Http\Request;

/*
 * handle all damage request API
 */
class DamageController extends ApiController
{

    /**
     * manage all damage reports logics
     * @var DamageService
     */
    private DamageService $damageService; // Damage service

    public function __construct(
        DamageService $damageService
    )
    {
        parent::__construct();
        $this->damageService = $damageService;
    }

    /**
     * Display a listing of the damage reports with pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
             $list = $this->damageService->getAll();

            if( $list['status']) {
                return $this->returnSuccess($list['data']);
            } else {
                return $this->returnError( $list['code'], isset($list['msg']));
            }

        } catch (\Exception $exception){
            return $this->returnError( 1001, $exception->getMessage());
        }
    }

    /**
     * List damages create by customer with pagination
     * - Customer's damage reports listing by customer reference
     *
     * @param $customer_reference
     * @return \Illuminate\Http\JsonResponse
     */
    public function customersList($customer_reference)
    {
        try{
            $list = $this->damageService->getAll( $customer_reference);

            if( $list['status']) {
                return $this->returnSuccess($list['data']);
            } else {
                return $this->returnError( $list['code'], isset($list['msg']));
            }
        } catch (\Exception $exception){
            return $this->returnError( 1001, $exception->getMessage());
        }
    }

    /**
     * Store a newly created damage record with images in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DamagePostRequest $request)
    {
        try{

            if(!$request->hasFile('image')) {
                return $this->returnError( 1005 ); // return error if not a Image
            }

            return $this->damageService->saveDamage($request);

        } catch (\Exception $exception){
            return $this->returnError( 1001, $exception->getMessage());
        }
    }

    /**
     * Display the specified damage record.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $data = $this->damageService->getDamage( $id);

            if( $data['status']) {
                return $this->returnSuccess($data['data']);
            } else {
                return $this->returnError( $data['code'], isset($data['msg']));
            }
        } catch (\Exception $exception){
            return $this->returnError( 1001, $exception->getMessage());
        }
    }

    /**
     * Update the specified damage report in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            ///return $request->all();
            return $this->damageService->updateDamage($request, $id);

        } catch (\Exception $exception){
            return $this->returnError( 1001, $exception->getMessage());
        }
    }

    /**
     * Remove the specified damage report from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
