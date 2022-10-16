<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\StudentRegisterRequest;
use App\Services\AuthService;


class AuthController extends Controller
{
    public function __construct (AuthService $authService) {

        $this->service = $authService;

    }


    public function Login(LoginRequest $request)
    {

        return $this->service->login($request);
    
    }


    public function register(RegisterRequest $request)
    {
        return $this->service->register($request);
    }

    public function studentRegister(StudentRegisterRequest $request)
    {
        return $this->service->register($request);
    }

    public function logout(Request $request)
    {
        
        return $this->service->logout($request);

    }
}
