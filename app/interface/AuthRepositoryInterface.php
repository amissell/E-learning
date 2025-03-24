<?php

namespace App\interface;

use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
  public function register(Request $request);
  public function login(Request $request);
  public function logout(Request $request);
  public function refreshToken(Request $request);
}