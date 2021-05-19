<?php

namespace EcommerceApp\Http\Controllers;

use EcommerceApp\Events\LoginHistory;
use EcommerceApp\Events\RegisterUser;
use EcommerceApp\Http\Requests\LoginRequest;
use EcommerceApp\Http\Requests\RegistrationRequest;
use EcommerceApp\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use EcommerceApp\Services\Response\ResponseService;

class UserController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $data = $request->validated();
        RegisterUser::dispatch($data);
        return ResponseService::successResponse($data,'User Created Successfully');
    }

    public function login(LoginRequest $request)
    { 
        $credentials = $request->validated();
        try
        {
            $token = JWTAuth::attempt($credentials);
            if(!$token)
            {
                return ResponseService::errorResponse(null,'Login Credentials are invalid');
            }
        }catch(JWTException $e)
        {
            return ResponseService::internalServerError(null,'Could not create token');
        }
        $user = $request->email;
        LoginHistory::dispatch($user);
        return ResponseService::successResponse($token,'Logged in Successfully');
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->header('Authorization'));
            return ResponseService::successResponse(null,'User has been logged out');
        } catch (JWTException $exception) {
            return ResponseService::internalServerError(null,'User cannot be logged out');
        }
    }

    public function profile(Request $request)
    {
        $user = JWTAuth::authenticate($request->header('Authorization'));
        return ResponseService::successResponse($user,'User Profile');
    }
}
