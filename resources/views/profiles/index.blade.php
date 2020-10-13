@extends('layouts.app')

@section('title', "{$user->username} Profile")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <img src="{{ $user->profile->profileImage() }}" class="logo_home rounded-circle p-5" alt="">
            </div>
            <div class="col-9 p-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex">
                        <h1>{{ $user->username }}</h1>

                        <follow-button user-id="{{ $user->id }}"> </follow-button>
                    </div>

                    @can('update', $user->profile)
                        <a href="/p/create">Add New Post</a>
                    @endcan
                </div>
                <div>
                    @can('update', $user->profile)
                        <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                    @endcan

                </div>
                <div class="d-flex">
                    <div class="pr-3"><strong>{{$user->posts->count()}} </strong>Post</div>
                    <div class="pr-3"><strong>220 </strong>Follower</div>
                    <div class="pr-3"><strong>99 </strong>Following</div>
                </div>
                <div class="pt-3 font-weight-bold">{{$user->profile->title}}</div>
                <div class="pt-3">{{$user->profile->description}} </div>
                <div class=""><a href="#">{{$user->profile->url ?? 'Not Avalaible'}}</a></div>
            </div>
        </div>
        <div class="row pt-5">
            @foreach($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{ $post->id}}">
                        <img src="/storage/{{ $post->image }}" class="w-100">
                    </a>

                </div>
            @endforeach
        </div>
        @if (! empty($nombres))
            <div>
                <ul>
                    @foreach ($nombres as $nombre)
                        <li>{{ $nombre }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
