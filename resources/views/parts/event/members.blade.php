@if ((Auth::guard('user')->check()) && ($event->isJoinedBy(Auth::guard('user')->user())) || (Auth::guard('admin')->check()))
    
    <div class="card mt-3">
        <div class="card-body d-flex flex-row">
            <h3>イベント参加者</h3>
            @foreach ($event->joins as $user)
                <a href="{{ route('user.show', ['id' => $user->id]) }}">
                <div>
                    <p>{{ $user->name }}</p>
                    @if (isset($user->image_path))
                        <p><img src="{{ asset('storage/image/user_images/'.$user->image_path) }}" alt=""></p>
                    @endif
                </div>
                </a>
            @endforeach
        </div>
    </div>
    
@endif