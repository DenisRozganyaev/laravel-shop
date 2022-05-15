<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|string|email",
            "password" => "required|string"
        ]);
        $credentials = request(["email", "password"]);
        // print_r($credentials);die;
        if (!Auth::attempt($credentials)) {
            return response()->json([
                "message" => "Unauthorized"
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken("Personal Access Token");
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            "access_token" => $tokenResult->accessToken,
            "token_type" => "Bearer",
            "expires_at" => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            "fName" => "required|string",
            "lName" => "required|string",
            "email" => "required|string|email|unique:users",
            "password" => "required|string"
        ]);

        $user = new User;
        $user->first_name = $request->fName;
        $user->last_name = $request->lName;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            "message" => "Successfully created user!"
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(["message" => "Successfully logged out"]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /* ----------------- get both access_token and refresh_token ---------------- */
    public function loginGrant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $baseUrl = url('/');
        $response = Http::post("{$baseUrl}/oauth/token", [
            'username' => $request->email,
            'password' => $request->password,
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
            'grant_type' => 'password'
        ]);

        $result = json_decode($response->getBody(), true);
        if (!$response->ok()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json($result);
    }

    /* -------------------------- refresh access_token -------------------------- */
    public function refreshToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'refresh_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $baseUrl = url('/');
        $response = Http::post("{$baseUrl}/oauth/token", [
            'refresh_token' => $request->refresh_token,
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
            'grant_type' => 'refresh_token'
        ]);

        $result = json_decode($response->getBody(), true);
        if (!$response->ok()) {
            return response()->json(['error' => $result['error_description']], 401);
        }
        return response()->json($result);
    }
}
