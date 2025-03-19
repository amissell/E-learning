<?php

namespace App\Services;

use App\interface\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(Request $request)
    {
        return $this->authRepository->register($request);
    }

    public function login(Request $request)
    {
        return $this->authRepository->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authRepository->logout($request);
    }
    
    
    public function refreshToken(Request $request)
    {
        return $this->authRepository->refreshToken();
    }

    public function getDetailsUsers(Request $request)
    {
        return $this->authRepository->getDetailsUsers();
    }
}
