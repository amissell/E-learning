<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        return response()->json($this->authService->register($request), 201);
    }

    public function login(Request $request)
    {
        return response()->json($this->authService->login($request), 200);
    }

    public function logout(Request $request)
    {
        return response()->json($this->authService->logout($request), 200);
    }

    public function refreshToken(Request $request)
    {
        return response()->json($this->authService->refreshToken($request), 200);
    }

    

    // public function getDetailsUsers(Request $request)
    // {
    //     return response()->json($this->authService->getDetailsUsers($request), 200);
    // }
}
