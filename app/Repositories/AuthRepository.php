<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\interface\AuthRepositoryInterface;


class AuthRepository implements AuthRepositoryInterface
{
  public function register(Request $request)
  {
    $fields = $request->validate([
      'name' => 'required|max:255',
      'email' => 'required|email|unique:users',
      'password' => 'required|confirmed',
      'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $imagePath = $request->file('image')->store('profile_images', 'public');

    $user = User::create([
      'name' => $fields['name'],
      'email' => $fields['email'],
      'password' => bcrypt($fields['password']),
      'image' => $imagePath,
    ]);

    $token = $user->createToken($request->name);
    return [
      'user' => $user,
      'token' => $token->plainTextToken,
      'image_url' => asset('storage/' . $user->image)
    ];
    $user->assignRole('student');
    return response()->json(['message' => 'User registered successfully']);
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users',
      'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      return [
        'message' => 'The provided credentials are incorrect!'
      ];
    }

    $token = $user->createToken($user->name);
    return [
      'user' => $user,
      'token' => $token->plainTextToken,
    ];

    $user = Auth::user();
    $user->tokens()->delete;
    $accessTokenExpiresAt = Carbon::now()->addDays(1);
    $refreshTokenExpiresAt = Carbon::now()->addDays(7);

    $accessToken = $user->createToken('access_token', ['*'], $accessTokenExpiresAt)->plainTextToken;
    $refreshToken = $user->createToken('refresh_token', ['refresh'], $refreshTokenExpiresAt)->plainTextToken;


    return response()->json(
      [
        'access_token' => $accessToken,
        'access_token_expires_at' => $accessTokenExpiresAt,
        'refresh_token' => $refreshToken,
        'refresh_token_expires_at' => $refreshTokenExpiresAt,
        'token_type' => 'Bearer',
      ]
      );
  }

  public function logout(Request $request)
  {
    $request->user()->tokens()->delete();

    return [
      'message' => 'you are logged out !'
    ];
  }

  public function refreshToken(Request $request)
    {
        $currentRefreshToken = $request->bearerToken();
        $refreshToken = PersonalAccessToken::findToken($currentRefreshToken);

        if (!$refreshToken || !$refreshToken->can('refresh') || $refreshToken->expires_at->isPast()) {
            return response()->json(['error' => 'Invalid or expired refresh token'], 401);
        }

        $user = $refreshToken->tokenable;
        $refreshToken->delete();

        $accessTokenExpiresAt = Carbon::now()->addDays(1);
        $refreshTokenExpiresAt = Carbon::now()->addDays(7);

        $newAccessToken = $user->createToken('access_token', ['*'], $accessTokenExpiresAt)->plainTextToken;
        $newRefreshToken = $user->createToken('refresh_token', ['refresh'], $refreshTokenExpiresAt)->plainTextToken;

        return response()->json([
            'access_token' => $newAccessToken,
            'access_token_expires_at' => $accessTokenExpiresAt,
            'refresh_token' => $newRefreshToken,
            'refresh_token_expires_at' => $refreshTokenExpiresAt,
            'token_type' => 'Bearer',
        ]);
    }

}
