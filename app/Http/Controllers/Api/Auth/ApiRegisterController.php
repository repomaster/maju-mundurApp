<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

use App\Http\Requests\ApiRegisterFormRequest;

use App\Http\Resources\UserResource;

use App\Role;

class ApiRegisterController extends Controller
{
    public function __invoke(ApiRegisterFormRequest $request)
    {
        event(new Registered($user = $this->create($request)));

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'data' => new UserResource($user),
            'access_token' => $accessToken
        ], 200);
    }

    private function create($request)
    {
        $role = Role::findOrFail($request->role);

        return $role->users()->create($this->toArray($request));
    }

    private function toArray($request)
    {
        return [
            'name' => $request->name,
            'shop_name' => $request->shop_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ];
    }
}
