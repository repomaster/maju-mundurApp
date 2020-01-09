@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Reward</div>

                <div class="card-body">
                    @include('layouts.partial.message')

                    <div class="well">
                        <h5><b>Your Point :</b></h5>
                        <h5><b>{{ $point->points }}</b> </h5>
                    </div>

                    <div class="row">
                        @forelse ($rewards as $reward)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $reward->name }}</h5>
                                        <p class="card-text">{{ $reward->price }}</p>
                                        <form action="{{ route('customer.reward.store', $reward->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Redeem</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="well">
                                <h5><b>No Reward.</b></h5>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Reward History</div>

                <div class="card-body">
                    <div class="row">
                        @forelse (auth()->user()->rewards as $reward)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $reward->name }}</h5>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="well">
                                <h5><b>No Reward History.</b></h5>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
