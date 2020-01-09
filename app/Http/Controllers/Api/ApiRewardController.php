<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\RewardResource;

use App\Reward;

class ApiRewardController extends Controller
{
    public function index()
    {
        return RewardResource::collection(Reward::query()->paginate(15));
    }

    public function show(Reward $reward)
    {
        return new RewardResource($reward);
    }
}
