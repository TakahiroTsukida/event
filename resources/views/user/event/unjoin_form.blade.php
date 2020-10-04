@extends('layouts.app')

@section('title', 'イベントキャンセルフォーム')

@section('content')
<div class="container">
    <div>
        <h1>イベントキャンセルフォーム</h1>
    </div>
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

        <form method="POST" action="{{ route('user.event.unjoin', ['event' => $event]) }}">
            @csrf
            @method('DELETE')

            <label>
                <input type="checkbox" name="kiyaku" value="1">
                規約に同意する
            </label>

            <div class="join">
                <!-- Button trigger modal -->
                <button type="button" class="cancel-btn" data-toggle="modal" data-target="#exampleModalPopovers">
                    予約をキャンセルする
                </button>
            </div>

            <div id="exampleModalPopovers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalPopoversLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalPopoversLabel">予約のキャンセル</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>下記のキャンセルボタンを押すとキャンセル処理が確定されます。<br>
                                本当に <strong>{{ $event->name }}</strong> の予約をキャンセルしますか？</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-danger">予約を取り消す</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection