<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Sign up
     *
     * @param SignupRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(SignupRequest $request)
    {
        $user = User::query()->create(
            ['password' => Hash::make($request->password)] + $request->validated()
        );

        return response()->json([
            'data' => [
                'user_token' => $user->generateToken()
            ]
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            return response()->json([
                'data' => [
                    'user_token' => Auth::user()->generateToken()
                ]
            ], 201);
        }

        return response()->json([
            'error' => [
                'code' => 401,
                'message' => 'Authentication failed'
            ]
        ], 401);
    }

    public function logout()
    {
        Auth::user()->removeToken();

        return response()->json([
            'message' => 'logout'
        ]);
    }
}
