@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h1 class="h3 card-title text-center mt-2">プロフィール編集</h1>

                    @include('parts/error_card_list')

                    <div class="card-text">
                        <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                            @csrf

                            @if (isset($user->image_path))

                            <div class="form-text text-info">
                                <p>設定中</p>
                                <p>
                                    <img src="{{ asset('storage/image/user_images/'.$user->image_path) }}">
                                </p>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">
                                    画像を削除
                                </label>
                            </div>
                            @else
                            <div class="custom-file mt-3 mb-5">
                                <input type="file" name="image" class="custom-file-input" id="customFileLang" lang="utf-8">
                                <label class="custom-file-label" for="customFileLang">画像を選択する</label>
                            </div>
                            @endif

                            @include('parts/user/profile')

                            <button class="btn btn-block aqua-gradient mt-2 mb-2" type="submit">プロフィール更新</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection