<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $scopes = [];

        if (is_admin($request->user())) {
            $scopes = array_merge($scopes, ['view-products']);
        }

        $tokenData = $request->user()->createToken("Personal Access Token", $scopes);

        if ($request->remember_me) {
            $tokenData->token->expires_at = $tokenData->token->expires_at->addWeeks(1);
            $tokenData->token->save();
        }

        return response()->json([
            'access_token' => $tokenData->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $tokenData->token->expires_at->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json(['data' => $request->user()]);
    }
}
