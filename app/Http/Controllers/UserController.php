<?php

namespace EcommerceApp\Http\Controllers;

use EcommerceApp\Events\LoginHistory;
use EcommerceApp\Events\RegisterUser;
use EcommerceApp\Events\WelcomeMail;
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
        $type = 0;
        if($request->has('type'))
            $type = $request->type;
        $data = $request->validated();
        $data['type'] = $type;
        //dd($data);
        $registerUser = RegisterUser::dispatch($data);
        return ResponseService::registerSuccessfullResponse($registerUser);
    }

    public function login(LoginRequest $request)
    { 
        $credentials = $request->validated();

        try
        {
            $token = JWTAuth::attempt($credentials);
            if(!$token)
            {
                return ResponseService::invalidCredentialsResponse(null);
            }
        }catch(JWTException $e)
        {
            return ResponseService::internalServerErrorResponse(null);
        }
        
        $user = $request->email;
        LoginHistory::dispatch($user);
        // $userRoles = JWTAuth::user()->roles()->pluck('name');
        // dd($userRoles[0]);
        return ResponseService::loginSuccessfullResponse($token);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->header('Authorization'));
            return ResponseService::logoutSuccessfullResponse(null);
        } catch (JWTException $exception) {
            return ResponseService::internalServerErrorResponse(null);
        }
    }

    public function profile(Request $request)
    {
        $user = JWTAuth::authenticate($request->header('Authorization'));
        if($user)
        {
            return ResponseService::profileSuccessfullResponse($user);
        }

        return ResponseService::internalServerErrorResponse(null);
        
    }
}
