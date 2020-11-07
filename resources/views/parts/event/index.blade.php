@forelse ($events as $event)
    <div class="eventList-item">
        @if ($url === 'user')
            <a href="{{ route('user.event.show', ['event' => $event]) }}">
        @elseif ($url === 'admin')
            <a href="{{ route('admin.event.show', ['event' => $event]) }}">
        @endif
            <div class="d-flex flex-row">
                <div class="font-weight-bold event-body">
                    <h3 class="title">{{ $event->title }}</h3>
                    @if ($event->image_path)
                        <p class="img"><img src="{{ asset('storage/image/event_images/'.$event->image_path) }}"></p>
                    @endif
                    <h2 class="name">{{ $event->name }}</h2>
                </div>
            </div>
        </a>


        @foreach($event->tags as $tag)
            @if($loop->first)
                <div class="mt-2 mb-1 pl-3">
                    <div class="card-text line-height">
            @endif
                @if ($url === 'user')
                    <a href="{{ route('top', ['tags' => [$tag->id], 'date' => $date]) }}" class="border p-1 mr-1 mt-1 text-muted">
                        {{ $tag->hashtag }}
                    </a>
                @elseif ($url === 'admin')
                    <a href="{{ route('admin.event.index', ['tags' => [$tag->id], 'date' => $date]) }}" class="border p-1 mr-1 mt-1 text-muted">
                        {{ $tag->hashtag }}
                    </a>
                @endif
            @if($loop->last)
                    </div>
                </div>
            @endif
        @endforeach

        <div class="body">
            @if ($url === 'user')
                <a href="{{ route('user.event.show', ['event' => $event]) }}">
            @elseif ($url === 'admin')
                <a href="{{ route('admin.event.show', ['event' => $event]) }}">
            @endif
                <div class="about">
                    <p>{{ isset($event->shop) ? $event->shop->name : "オンライン"}}　|　{{ \Carbon\Carbon::parse($event->start_time)->isoFormat('MM月DD日（ddd）LT') }} 〜</p>
                    @if ($event->finish == "0")
                        <p>申し込み受付中</p>
                    @elseif ($event->finish == "1")
                        <p>受付は終了しました</p>
                    @endif
                </div>
            </a>

            @if ($url === 'user')

                @include('parts/event/join_button')

            @elseif ($url === 'admin')

                @include('parts/event/delete_btn')
            @endif

        </div>
    </div>
@empty
    <div class="event-empty">
        <label>対象イベントがありません</label>
    </div>
@endforelse
