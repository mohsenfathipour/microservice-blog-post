<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthCheckTokenRequest;
use App\Http\Requests\AuthLoginRequest;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {

        # Check email password:
        $user = User::where('email', $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password))
            return response()->json([
                'success' => false,
                'message' => 'email or password is invalid'
            ],Response::HTTP_UNPROCESSABLE_ENTITY);


        // Revoke all tokens...
        $user->tokens()->delete();

        $token = $user->createToken('web-access');

        return response()->json([
            'success' => true,
            'data' => ['token' => $token->plainTextToken , 'user' => $user]
        ]);
    }

    public function checkToken(AuthCheckTokenRequest $request)
    {
        $token = $request->input('token');

        $access_token = PersonalAccessToken::findToken($token);

        if (!$access_token)
            return response()->json([
                'success' => false,
                'message' => 'token is invalid'
            ],Response::HTTP_UNAUTHORIZED);

        $user = $access_token?->tokenable;

        return response()->json([
            'success' => true,
            'data' => $user
        ]);;

    }
}
