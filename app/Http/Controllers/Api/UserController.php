<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function Register(Request $request)
    {
        $userRequest = $request->all();
        // validation
        $validator = Validator::make($userRequest, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'status' => false
            ], 400);
        }

        // user create
        $userCreate = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),


        ]);


        // create token
        $token = $userCreate->createToken('myApp')->accessToken;

        return response()->json([
            'data' => $userCreate,
            'message' => 'success message',
            'token' => $token,
            'status' => true
        ]);
    }


    public function login(Request $request)
    {
        try {
            $user= $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            // check user auth [ email and password ]
            if (auth()->attempt($user)) {
                $user = auth()->user();
                $token = $user->createToken('API Token')->accessToken;
                return response()->json([
                    'data' => $user,
                    'token' => $token,
                    'message' => 'success message',
                    'status' => 200,
                    'success' => true
                ],200);
            } else {
                return response()->json([
                    'message' => 'email or password not correct',
                    'status' => false
                ], 401);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => 500
            ], 500);
        }
    }


    public function UserProfile(){

       $name = auth()->guard('api')->user()->name;
        $email = auth()->guard('api')->user()->email;
        $phone = auth()->guard('api')->user()->phone;


        return response()->json([
            'Name'=>$name,
            'Email'=>$email,
            'Phone'=>$phone
        ]);


    }
}

