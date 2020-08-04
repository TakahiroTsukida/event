@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-body">

            @if (empty($user->image_path))
            <div class="d-flex flex-row">
                <i class="fas fa-user-circle fa-3x"></i>
            </div>
            @else
            <p><img src="{{ asset('storage/image/user_images/'.$user->image_path) }}"></p>
            @endif
            <h2 class="h5 card-title m-0">{{ $user->name }}</h2>
            <p>{{ $user->gender == '0' ? '男性': '女性' }}</p>

            @php
                $now = date("Ymd");
                $user_birthday = str_replace("-", "", $user->birthday);
                $age = floor(($now-$user_birthday)/10000).'歳';
            @endphp
            <p>{{ $age }}</p>
            <p>{{ $user->introduction }}</p>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p></p>
            </div>
        </div>
    </div>
</div>
@endsection