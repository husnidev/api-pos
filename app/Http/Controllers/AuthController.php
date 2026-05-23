<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(
        RegisterRequest $request
    )
    {
        $user=User::create(
            $request->validated()
        );

        $token=$user
            ->createToken(
                'auth_token'
            )
            ->plainTextToken;

        return response()->json([
            'success'=>true,
            'message'=>'Register success',
            'data'=>[
                'user'=>$user,
                'token'=>$token
            ]
        ],201);
    }

    public function login(
        LoginRequest $request
    )
    {
        if(
            !Auth::attempt(
                $request->validated()
            )
        ){

            return response()->json([
                'success'=>false,
                'message'=>'Invalid credentials'
            ],401);

        }

        $user=Auth::user();

        $token=$user
            ->createToken(
                'auth_token'
            )
            ->plainTextToken;

        return response()->json([

            'success'=>true,

            'message'=>'Login success',

            'data'=>[
                'user'=>$user,
                'token'=>$token
            ]

        ]);
    }

    public function me(
        Request $request
    )
    {
        return response()->json([
            'success'=>true,
            'data'=>$request->user()
        ]);
    }

    public function logout(
        Request $request
    )
    {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Logout success'
        ]);
    }
}
