@extends('layouts.app')

@section('title', '登録店舗一覧')

@section('content')
<div class="container">
    <div class="text-right">
        <a href="{{ route('admin.shop.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> 店舗新規登録</a>
    </div>


    <table class="table table-bordered">

        <thead>
            <tr>
                <th>店舗名</th>
                <th>画像</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($shops as $shop)
            <tr>
                <td>
                    <a class="text-dark" href="{{ route('admin.shop.show', ['shop' => $shop]) }}">{{ $shop->name }}</a>
                </td>
                <td>
                    <a class="text-dark" href="{{ route('admin.shop.show', ['shop' => $shop]) }}">
                        <p class="shop-image">
                            @if (isset($shop->image_path))
                            <img src="{{ asset('storage/image/shop_images/'.$shop->image_path) }}">
                            @endif
                        </p>
                    </a>
                </td>
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
                                <a class="dropdown-item" href="{{ route('admin.shop.edit', ['shop' => $shop]) }}">
                                    <i class="fas fa-pen mr-1"></i>編集する
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $shop->id }}">
                                    <i class="fas fa-trash-alt mr-1"></i>削除する
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- dropdown -->
                    <!-- modal -->
                    <div id="modal-delete-{{ $shop->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('admin.shop.destroy', ['shop' => $shop]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        登録店舗から『{{ $shop->name }}』を削除します。<br>
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