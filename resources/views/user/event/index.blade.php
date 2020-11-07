@extends('layouts.app')

@section('title', 'イベント検索')

@section('content')
{{-- ロード中のアニメーション --}}
{{--<div id="loader-wrap">--}}
{{--    <div id="loader">Loading...</div>--}}
{{--</div>--}}
<div class="container event-index">
    <div class="search-group">
        <form action="{{ route('top') }}">
            @csrf
            <div class="purpose">
                <label class="mb-0">目的で調べる</label>
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

{{--            <div class="shop">--}}
{{--                <label>お店で調べる</label>--}}
{{--                <select name="shop_id">--}}
{{--                    <option value="" {{ $shop_id ? '' : 'selected' }}>指定なし</option>--}}
{{--                    <option value="200" {{ $shop_id == 200 ? 'selected' : '' }}>オンライン</option>--}}
{{--                    @foreach ($shops as $shop)--}}
{{--                    <option value="{{ $shop->id }}" {{ $shop_id == $shop->id ? 'selected' : '' }}>{{ $shop->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

            @include('parts/pref_select')

            <pref-city :prop-pref-data='@json($prefs)'
                prop-cities-data="@json([])">

            </pref-city>

            <div class="search-btn">
                <button type="submit">検索する</button>
            </div>

        </form>
    </div>

    {{-- vue start --}}
    <event-index
        :prop-event-data='@json($events->items())'
        :initial-current-page='@json($events->currentPage())'>
    </event-index>
    {{-- vue end --}}

    @include('parts/event/index')

</div>
@endsection
