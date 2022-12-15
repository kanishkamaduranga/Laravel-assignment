<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    //

    private User $user;

    public function __construct(
        User $user
    )
    {
        $this->user = $user;
    }

    /**
     * handle API user authentication
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        try{

            if (!Auth::attempt($request->only('email', 'password'))) {
                return $this->returnError( 1004 );
            }

            $user = $this->user->where('email', $request['email'])->firstOrFail();
            $token = $user->createToken('authToken')->plainTextToken;

            return $this->returnSuccess([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);

        } catch (\Exception $exception){
            return $this->returnError( 1001, $exception->getMessage());
        }
    }

}
