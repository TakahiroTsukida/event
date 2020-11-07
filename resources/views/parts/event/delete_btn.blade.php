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
                            登録イベントから<br>
                            『{{ $event->name }}』を削除します。<br>
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
