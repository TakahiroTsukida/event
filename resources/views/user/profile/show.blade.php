@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="container">


    <!-- プロフィール部分 -->
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
            <p>{{ $user->email }}</p>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p></p>
            </div>
        </div>
    </div>



    <!-- 参加予定イベント部分 -->
    @if ($user->id == Auth::guard('user')->user()->id)
    <div class="card mt-3">
        <div class="card-body">
            <p>参加予定のイベント</p>
            <ul>
                @foreach ($user->joins as $join)
                    @php
                        $week = array( "日", "月", "火", "水", "木", "金", "土" );
                        $start_day = date('w', strtotime($join->start_time));
                    @endphp
                <li>
                    <a href="{{ route('user.event.show', ['event' => $join]) }}">
                        <p>{{ $join->name }}</p>
                    </a>
                    <p>{{ date('n/j（'.$week[$start_day].'）H:i〜', strtotime($join->start_time)) }}</p>
                </li>

                    @php
                        unset($start_day);    
                    @endphp
                @endforeach
            </ul>
        </div>
    </div>


    <!-- お気に入りイベント一覧 -->
    <div class="card mt-3">
        <div class="card-body">
            <p>お気に入りイベント</p>

            <ul>
            @foreach ($user->likes as $like)
                @php
                    $week = array( "日", "月", "火", "水", "木", "金", "土" );
                    $start_day = date('w', strtotime($like->start_time));
                @endphp
                <li>
                    <a href="{{ route('user.event.show', ['event' => $like]) }}">
                        <p>{{ $like->name }}</p>
                    </a>
                    <p>{{ date('n/j（'.$week[$start_day].'）H:i〜', strtotime($like->start_time)) }}</p>
                </li>

                @php
                    unset($start_day);    
                @endphp
            @endforeach
            </ul>

        </div>
    </div>
    @endif



</div>
@endsection