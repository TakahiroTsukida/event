@extends('layouts.app')

@section('title', '管理者ページ')

@section('content')
<div class="container">
    <div class="text-right">
        <a href="{{ route('admin.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> 管理ユーザー作成</a>
    </div>


    <table class="table table-bordered">

        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    <!-- dropdown -->
                    <div class="ml-auto card-text">
                        <div class="dropdown text-center">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button type="button" class="btn btn-link text-muted m-0 p-0">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.edit', ['admin' => $admin]) }}">
                                    <i class="fas fa-pen mr-1"></i>編集する
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $admin->id }}">
                                    <i class="fas fa-trash-alt mr-1"></i>削除する
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- dropdown -->
                    <!-- modal -->
                    <div id="modal-delete-{{ $admin->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('admin.destroy', ['admin' => $admin]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        管理ユーザーから『{{ $admin->name }}』を削除します。<br>
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
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection