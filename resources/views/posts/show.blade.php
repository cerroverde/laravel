@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class='w-100'>
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px">
                    </div>
                    <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark pr-1"> {{ $post->user->username }} </span>
                            </a>
                            <a href="#">Follow</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class=" d-flex float-left">
                        <a href="/profile/{{ $post->user->id }}">
                            <span class="font-weight-bold text-dark pr-1 "> {{ $post->user->username }} </span>
                        </a>

                    </div>
                    <p> {{ $post->caption }} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
