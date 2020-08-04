@extends('layouts.app')

@section('title', '管理ユーザー作成')

@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h1 class="h3 card-title text-center mt-2">管理ユーザー新規登録</h1>

                    @include('parts/error_card_list')

                    <div class="card-text">
                        <form method="POST" action="{{ route('admin.store') }}">
                            
                            @include('parts.admin.form')
                            
                            <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">登録</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection