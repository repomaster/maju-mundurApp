<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\ApiLoginFormRequest;

use App\Http\Resources\UserResource;

class ApiLoginController extends Controller
{
    public function login(ApiLoginFormRequest $request)
    {
        if ($this->attemptLogin($request)) {
            $user = auth()->user();
            $accessToken = $user->createToken('authToken')->accessToken;

            return response()->json([
                'data' => new UserResource($user),
                'access_token' => $accessToken
            ], 200);
        }

        return response()->json(['The user credentials were incorrect.'], 200);
    }

    public function logout(Request $request)
    {
        $accessToken = $request->user()->token();
        $accessToken->revoke();

        return response()->json(['You have been succesfully logged out!'], 200);
    }

    private function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    private function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    private function username()
    {
        return 'email';
    }

    private function guard()
    {
        return auth()->guard();
    }
}
