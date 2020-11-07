@extends('layouts.app')

@section('title', 'イベント新規登録')

@section('content')
    <div class="container event-index">
        <h1>管理画面　イベント検索</h1>
        <div class="search-group">
            <form action="{{ route('admin.event.index') }}" method="get">
                <div class="purpose">
                    <label>タグで調べる</label>
                    <div class="search-tags">
                        @foreach ($allTags as $tag)
                            <label class="tag">
                                <input type="checkbox" name="tags[{{$loop->iteration}}]" value="{{ $tag->id }}" {{ isset($tags) && in_array($tag->id, $tags) ? 'checked' : '' }}>
                                <p>{{ $tag->name }}</p>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="day">
                    <label>日時で調べる</label>
                    <calendar :prop-date='@json($date->format('Y-m-d'))'></calendar>
                </div>

{{--                <div class="shop">--}}
{{--                    <label>お店で調べる</label>--}}
{{--                    <select name="shop_id">--}}
{{--                        <option value="" {{ $shop_id ? '' : 'selected' }}>指定なし</option>--}}
{{--                        @foreach(\App\Admin\Event::EVENT_HELD as $key => $value)--}}
{{--                            <option value="{{ $value }}"{{ $shop_id == $value ? 'selected' : '' }}>{{ $key }}</option>--}}
{{--                        @endforeach--}}
{{--                        @foreach($shops as $shop)--}}
{{--                            <option value="{{ $shop->id }}" {{ $shop_id == $shop->id ? 'selected' : '' }}>{{ $shop->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

                @include('parts/pref_select')

                <div class="sort">
                    <label>並び替え</label>
                    <select name="sort" class="form-control">
                        <option value="1" {{$sort == '1' ? 'selected' : ''}}>開催日が早い順</option>
                        <option value="2" {{$sort == '2' ? 'selected' : ''}}>新しく作成した順</option>
                    </select>
                </div>

                <div class="search-btn">
                    <button type="submit">検索する</button>
                </div>

            </form>
        </div>


        @include('parts/event/index')

        <div>
            {{ $events->appends(request()->input())->links() }}
        </div>
    </div>
@endsection
