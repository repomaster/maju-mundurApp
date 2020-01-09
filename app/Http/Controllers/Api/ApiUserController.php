<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\UserResource;

use App\User;

class ApiUserController extends Controller
{
    public function __invoke(User $user)
    {
        return new UserResource($user);
    }
}
