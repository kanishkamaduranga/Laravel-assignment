<?php

namespace App\Http\Controllers\Api;

use App\Constant\Status_codes;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/*
 * parent class for all API class
 */
class ApiController extends Controller
{
    public function __construct(){}

    /** return and formatting success response
     * @param $data
     * @param $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnSuccess($data = array(), $status_code = 200){

        return ResponseHelper::returnSuccess( $data, $status_code);
    }

    /** return and formatting error response
     * @param $status_code
     * @param $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnError($status_code = 404, $msg = []){

        return ResponseHelper::returnError( $status_code, $msg);
    }
}
