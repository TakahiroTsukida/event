@unless (Auth::guard('admin')->check())
    @if ($event->isJoinedBy(Auth::guard('user')->user()))

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalPopovers{{ $event->id }}">
            予約をキャンセルする
        </button>

        <div id="exampleModalPopovers{{ $event->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalPopoversLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalPopoversLabel">予約のキャンセル</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>本当にこの予約をキャンセルしますか？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form method="POST" action="{{ route('user.event.unjoin', ['event' => $event]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">予約を取り消す</button>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>

    @else

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalPopovers{{ $event->id }}">
            参加を申し込む
        </button>

        <div id="exampleModalPopovers{{ $event->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalPopoversLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalPopoversLabel">チケットの選択</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <i class="fas fa-female"></i>
                        <a href="{{ route('user.event.join_form', ['event' => $event]) }}" class="btn btn-success">参加を申し込む</a>
                        <hr>
                        <i class="fas fa-male"></i>
                        <a href="{{ route('user.event.join_form', ['event' => $event]) }}" class="btn btn-success">参加を申し込む</a>
                    </div>
                </div>
            </div>
        </div>

    @endif
@endif