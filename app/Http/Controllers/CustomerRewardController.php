<?php

namespace App\Http\Controllers;

use App\Reward;
use Illuminate\Http\Request;

class CustomerRewardController extends Controller
{
    public function index()
    {
        $point = auth()->user()->point;
        $rewards = Reward::query()->get();

        return view('customer.reward.index', compact('point', 'rewards'));
    }

    public function store(Reward $reward)
    {
        $user = auth()->user();
        if ($user->point) {
            if ($user->point->points >= $reward->price) {
                $user->rewards()->attach($reward);
                $user->point()->update(['points' => $user->point->points - $reward->price]);

                return redirect()->route('customer.reward.index')->with('success', 'Redeem Successfully.');
            }
        }

        return redirect()->route('customer.reward.index')->with('error', 'Not enough point.');
    }
}
