<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{
    /**
     * Login a user
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse {
        $credentials = $request->only('email', 'password'); 

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            } 
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Could not create token'
            ], 500);
        }

        return response()->json([
            'message' => 'Login successful',
            'token' => $token
        ]);

    }


    /**
     * Logout a user
     */

     public function logout(): JsonResponse {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'message' => 'Logout successful'
        ]);
     }


     /**
      * Get the authenticated User
      * @return \Illuminate\Http\JsonResponse
      */
     public function me(Request $request): JsonResponse {
        try {
            $user = JWTAuth::user();
            return response()->json([
                'user' => $user
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Could not get user'
            ], 500);
        }
     }


     /** 
      * Refresh a token
      * @return \Illuminate\Http\JsonResponse
      */
     public function refresh(Request $request): JsonResponse {

        $token = JWTAuth::refresh(JWTAuth::getToken()); 

        if (!$token) {
            return response()->json([
                'message' => 'Could not refresh token'
            ], 500);
        }

        return response()->json([
            'message' => 'Token refreshed',
            'token' => $token
        ]);
     }
}
