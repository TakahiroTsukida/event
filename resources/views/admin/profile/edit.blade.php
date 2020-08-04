@extends('layouts.app')

@section('title', '管理ユーザー編集')

@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h1 class="h3 card-title text-center mt-2">管理ユーザー編集</h1>
                    @include('parts.error_card_list')
                    <div class="card-text">
                        <form method="POST" action="{{ route('admin.update', ['admin' => $admin]) }}">
                            @method('PATCH')

                            @include('parts.admin.form')

                            <button type="submit" class="btn blue-gradient btn-block">更新する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection