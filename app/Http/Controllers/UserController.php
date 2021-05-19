<?php

namespace EcommerceApp\Http\Controllers;

use EcommerceApp\Events\LoginHistory;
use EcommerceApp\Events\RegisterUser;
use EcommerceApp\Http\Requests\RegistrationRequest;
use EcommerceApp\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $data = $request->validated();

        $saveHistory = RegisterUser::dispatch($data);
        return response()->json([
            'success' => true,
            'message' => 'User Created successfully'
        ],Response::HTTP_OK);
    }

    public function login(Request $request)
    { 
        $credentials = $request->only('email','password');
        $rules = [
            'email' => 'required | email',
            'password' => 'required | string | min:6 | max:20'
        ];
        $validator = Validator::make($credentials,$rules);
        if($validator->fails())
        {
            return response()->json(['error' => $validator->errors()],200);
        }

        try
        {
            $token = JWTAuth::attempt($credentials);
            if(!$token)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 400);
            }
        }catch(JWTException $e)
        {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }
        $user = $request->email;
        LoginHistory::dispatch($user);
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->header('Authorization'));
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function profile(Request $request)
    {
        $user = JWTAuth::authenticate($request->header('Authorization'));
        return response()->json(['user' => $user]);
    }
}
