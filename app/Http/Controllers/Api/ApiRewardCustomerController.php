<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRewardCustomerFormRequest;

use App\Http\Resources\RewardResource;

use App\Reward;

class ApiRewardCustomerController extends Controller
{
    public function index()
    {
        return RewardResource::collection(auth()->user()->rewards()->paginate(15));
    }

    public function store(ApiRewardCustomerFormRequest $request)
    {
        $user = auth()->user();
        $reward = Reward::findOrFail($request->reward_id);
        if ($user->point->points >= $reward->price) {
            $user->rewards()->attach($reward);
            $user->point()->update(['points' => $user->point->points - $reward->price]);

            return new RewardResource($reward);
        }

        return response()->json([
            'message' => 'Not Enough Point.'
        ], 200);
    }
}
