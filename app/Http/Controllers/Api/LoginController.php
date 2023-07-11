<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest ;
use App\Http\Resources\UserResource ;
use App\Http\Helpers\Helper ;

/* 
use Illuminate\Http\Exceptions\HttpResponseException ;
use Illuminate\Contracts\Validation\Validator;
 */
use Auth ;
class LoginController extends Controller
{
    //
    public function login(LoginRequest $request ){
        //login user
        //return true ;
        //if(!Auth::attempt(['email' => $email, 'password' => $password])){
        if(!Auth::attempt($request->only('email','password'))){

            Helper::sendError('Email or password is wrong');

            /* throw new HttpResponseException(
                response()->json([
                    'success' => 'False',
                    'message' => 'Email or password is wrong',
                    'data' => $validator->errors()
                    ,
    
                ], 422)
            ); */
        }
        //send response
        return new UserResource(auth()->user()) ;

    }
}
