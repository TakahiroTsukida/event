@extends('layouts.app')

@section('title', 'イベント検索')

@section('content')
<div class="container">
    @foreach ($events as $event)

    @php
        $week = array( "日", "月", "火", "水", "木", "金", "土" );

        $start_day = date('w', strtotime($event->start_time));

        $end_day = date('w', strtotime($event->end_time));

        $deadline = date('w', strtotime($event->deadline));
    @endphp
    
    <div class="eventList-item">
        <a href="{{ route('user.event.show', ['event' => $event]) }}">
            <div class="d-flex flex-row">
                <div class="font-weight-bold">
                    <h3 class="title">{{ $event->title }}</h3>
                    @if ($event->image_path)
                    <p class="img"><img src="{{ asset('storage/image/event_images/'.$event->image_path) }}"></p>
                    @endif
                    <h2 class="name">{{ $event->name }}</h2>
                </div>
            </div>
        </a>
        
        <!-- いいねボタン -->
        @include('parts/event/like_button')
        
        <div class="body">
            <a href="{{ route('user.event.show', ['event' => $event]) }}">
                <div class="about">
                    <p>{{ isset($event->shop) ? $event->shop->name : "オンライン"}}　|　{{ date('n/j（'.$week[$start_day].'）H:i〜', strtotime($event->start_time)) }}</p>

                    @if ($event->finish == "0")
                    <p>申し込み受付中</p>
                    @elseif ($event->finish == "1")
                    <p>受付は終了しました</p>
                    @endif
                </div>
            </a>

            @include('parts/event/join_button')

            <div class="show">

                @if (Auth::guard('admin')->check())
                <a href="{{ route('admin.event.edit', ['event' => $event]) }}" class="btn btn-success btn-rounded mt-2 mb-2">編集</a>

                <a class="btn btn-danger btn-rounded mt-2 mb-2" data-toggle="modal" data-target="#modal-delete-{{ $event->id }}">削除</a>

                <!-- modal -->
                <div id="modal-delete-{{ $event->id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('admin.event.destroy', ['event' => $event]) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    登録イベントから『{{ $event->name }}』を削除します。<br>
                                    削除したデータはもとに戻せません。<br>
                                    よろしいですか？
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                    <button type="submit" class="btn btn-danger">削除する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- modal -->
                @endif
            </div>

        </div>
    </div>

    @php
        unset($start_day);
        unset($end_day);
        unset($deadline);        
    @endphp

    @endforeach
</div>
@endsection