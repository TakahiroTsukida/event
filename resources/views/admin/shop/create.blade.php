@extends('layouts.app')

@section('title', '店舗新規登録')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body pt-0">
                    <h1 class="h3 card-title text-center mt-2">店舗新規登録</h1>
                    
                    @include('parts/error_card_list')
                    
                    <div class="card-text">
                        <form method="POST" action="{{ route('admin.shop.store') }}" enctype="multipart/form-data">
                            @include('parts.shop.form')

                            <button type="submit" class="btn blue-gradient btn-block">登録する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection