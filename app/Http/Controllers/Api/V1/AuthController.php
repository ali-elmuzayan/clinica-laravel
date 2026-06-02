<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Login a user
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid credentials',
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Could not create token',
            ], 500);
        }

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ]);

    }

    /**
     * Logout a user
     */
    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }

    /**
     * Get the authenticated User
     */
    public function me(Request $request): JsonResponse
    {
        try {
            $user = JWTAuth::user();

            return response()->json([
                'user' => $user,
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Could not get user',
            ], 500);
        }
    }

    /**
     * Refresh a token
     */
    public function refresh(Request $request): JsonResponse
    {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());

            return response()->json([
                'message' => 'Token refreshed',
                'token' => $token,
            ]);

        } catch (JWTException $e) {
            return response()->json([
                'message' => 'You are not authenticated.',
            ], 401);
        }
    }
}
