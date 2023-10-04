<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = JWTAuth::attempt($input);
        if ($jwt_token) {
            return response()->json([
                'con' => true,
                'message' => 'loging success',
                'token' => $jwt_token,
            ]);
        } else {
            return response()->json([
                'con' => false,
                'message' => 'creditial error!',
            ]);
        }
    }

    public function me()
    {
        return response()->json([
            'con' => true,
            'message' => 'Your Infos',
            'user' => auth()->user(),
        ]);
    }
}
