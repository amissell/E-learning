<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\interface\AuthRepositoryInterface;
use Illuminate\Http\Request;

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
  }

  public function logout(Request $request)
  {
    $request->user()->tokens()->delete();

    return [
      'message' => 'you are logged out !'
    ];
  }
}
