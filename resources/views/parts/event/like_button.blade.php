<div class="card-body pt-0 pb-2 pl-3">
    <div class="card-text">
        <event-like :initial-is-liked-by="@json($event->isLikedBy(Auth::guard('user')->user()))" :initial-count-likes='@json($event->count_likes)' :authorized="@json(Auth::guard('user')->check())" endpoint="{{ route('user.event.like', ['event' => $event]) }}">
        </event-like>
    </div>
</div>