<?php

namespace App\Helper;

use App\Constant\Status_codes;
use Illuminate\Support\Facades\Response;

class ResponseHelper
{


    /** return and formatting success response
     * @param $data
     * @param $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function returnSuccess($data = array(), $status_code = 200){

        $code_length = strlen((string)$status_code);
        return Response::json(
            [
                'status' => $status_code,
                'description' => Status_codes::status[$status_code],
                'data' => $data
            ], (int)200
        );
    }

    /** return and formatting error response
     * @param $status_code
     * @param $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public static function returnError($status_code = 404, $msg = []){

        $code_length = strlen((string)$status_code);

        $return_array =  [
            'status' => $status_code,
            'description' => Status_codes::status[$status_code],
            'error_code' => $status_code,
            'messages' => $msg,
        ];

        if($code_length>3){
            $return_array['status'] = 404;
        }

        return Response::json( $return_array, (int)$return_array['status']);
    }

}
