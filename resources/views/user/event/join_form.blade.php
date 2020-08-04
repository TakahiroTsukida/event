@extends('layouts.app')

@section('title', 'イベント参加フォーム')

@section('content')
<div class="container">
    
    @if ($errors->any())
    <div class="card-text text-left alert alert-danger">
        <ul class="mb-0">
            <li>規約に同意してください</li>
        </ul>
    </div>
    @endif

    <div class="card mt-3">
        <p>{{ $event->name }}</p>
        <p>{{ $event->title }}</p>
        <p>{{ Auth::guard('user')->user()->gender == "0" ? "男" : "女"}}</p>
        <p>利用規約</p>

        <form method="POST" action="{{ route('user.event.join',['event' => $event]) }}">
            @csrf

            <label>
                <input type="checkbox" name="kiyaku" value="1">
                規約に同意する
            </label>

            <button type="submit">参加を申し込む</button>
        </form>
    </div>
</div>
@endsection