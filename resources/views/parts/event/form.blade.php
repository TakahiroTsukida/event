@csrf
<div class="md-form">
    <label for="name">イベント名</label>
    <input id="name" type="text" name="name" class="form-control" required value="{{ $event->name ?? old('name') }}">
</div>

<div class="md-form">
    <label for="title">タイトル</label>
    <input id="title" type="text" name="title" class="form-control" value="{{ $event->title ?? old('title') }}">
</div>

<div class="form-group">
    <label>目的</label>
    <event-tags-input
        :initial-tags='@json($tagName ?? [])'
        :autocomplete-items='@json($allTagNames ?? [])'
    >
    </event-tags-input>
</div>

<div class="form-group">
    <label class="mdb-main-label">開催店舗</label>
    <select name="shop_id" class="browser-default custom-select">
        <option value="">選択してください</option>
        <option value="200" @if(isset($event->shop_id)) {{ $event->shop_id == "200" ? 'selected' : '' }} @elseif(old('shop_id') == "200") {{ 'selected' }} @endif>オンライン</option>
        @foreach ($shops as $shop)
        <option value="{{ $shop->id }}" @if(isset($event->shop_id)) {{ $event->shop_id == $shop->id ? 'selected' : '' }} @elseif(old('shop_id') == $shop->id) {{ 'selected' }} @endif>{{ $shop->name }}</option>
        @endforeach

    </select>
</div>

<div class="form-group">
    <label>開始予定時間</label>
    <input type="datetime-local" name="start_time" class="form-control" value="{{ isset($event->start_time) ? str_replace(" ", "T", $event->start_time) : str_replace(" ", "T", old('start_time')) }}">
</div>

<div class="form-group">
    <label>終了予定時間</label>
    <input type="datetime-local" name="end_time" class="form-control" value="{{ isset($event->end_time) ? str_replace(" ", "T", $event->end_time) : str_replace(" ", "T", old('end_time')) }}">
</div>

<div class="form-group">
    <label>申し込み締切り</label>
    <input type="datetime-local" name="deadline" class="form-control" value="{{ isset($event->deadline) ? str_replace(" ", "T", $event->deadline) : str_replace(" ", "T", old('deadline')) }}">
</div>

<div class="text-left">
    <!-- Default inline 1-->
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="defaultInline1" name="tax" value="0" @if(isset($event->tax)) {{ $event->tax == '0' ? 'checked' : ''}} @else {{ old('tax') == '0' ? 'checked' : ''}} @endif>
        <label class="custom-control-label" for="defaultInline1">税込み</label>
    </div>

    <!-- Default inline 2-->
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="defaultInline2" name="tax" value="1" @if(isset($event->tax)) {{ $event->tax == '1' ? 'checked' : ''}} @else {{ old('tax') == '1' ? 'checked' : ''}} @endif>
        <label class="custom-control-label" for="defaultInline2">税抜き</label>
    </div>
</div>

<div class="form-group">
    <label></label>
    <textarea name="descripsion" required class="form-control" rows="16" placeholder="イベントの概要">{{ $event->descripsion ?? old('descripsion') }}</textarea>
</div>

<div class="form-group">
    <label></label>
    <textarea name="conditions" required class="form-control" rows="16" placeholder="参加条件">{{ $event->conditions ?? old('conditions') }}</textarea>
</div>

@if (isset($event->image_path))
<div class="form-text text-info">
    <p>設定中</p>
    <p>
        <img src="{{ asset('storage/image/event_images/'.$event->image_path) }}">
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



@if (isset($event->prices))
    @foreach ($event->prices as $price)
    <div class="form-row">
        <div class="col md-form">
            <label for="gender{{$loop->iteration}}">性別</label>
            <input id="gender{{$loop->iteration}}" type="text" name="price[gender][]" class="form-control" value="{{ $price->gender }}">
        </div>
        <div class="col md-form">
            <label for="price{{$loop->iteration}}">参加費</label>
            <input id="price{{$loop->iteration}}" type="number" name="price[price][]" class="form-control" value="{{ $price->price }}">
        </div>
        <div class="col md-form">
            <label for="status{{$loop->iteration}}">備考</label>
            <input id="{{$loop->iteration}}" type="text" name="price[status][]" class="form-control" value="{{ $price->status }}">
        </div>
        <div class="col md-form">
            <label for="notes{{$loop->iteration}}">注意事項</label>
            <input id="notes{{$loop->iteration}}" type="text" name="price[notes][]" class="form-control" value="{{ $price->notes }}">
        </div>
    </div>
    @endforeach
@else
    @for ($i = 0; $i < 2; $i++)
    <div class="form-row">
        <div class="col md-form">
            <label for="new_gerder{{$i}}">性別</label>
            <input id="new_gerder{{$i}}" type="text" name="price[gender][]" class="form-control" value="{{ old('price.gender.$i') }}">
        </div>
        <div class="col md-form">
            <label for="new_price{{$i}}">参加費</label>
            <input id="new_price{{$i}}" type="number" name="price[price][]" class="form-control" value="{{ old('price.price.$i') }}">
        </div>
        <div class="col md-form">
            <label for="status{{$i}}">備考</label>
            <input id="status{{$i}}" type="text" name="price[status][]" class="form-control" value="{{ old('price.status.$i') }}">
        </div>
        <div class="col md-form">
            <label for="new_notes{{$i}}">注意事項</label>
            <input id="new_notes{{$i}}" type="text" name="price[notes][]" class="form-control" value="{{ old('price.notes.$i') }}">
        </div>
    </div>
    @endfor
@endif

@if (isset($event->schedules))
    @foreach ($event->schedules as $schedule)
    <div class="form-row">
        <div class="col md-form">
            <label for="schedule{{$loop->iteration}}">スケジュール名</label>
            <input id="schedule{{$loop->iteration}}" type="text" name="schedule[name][]" class="form-control" value="{{ $schedule->name }}">
        </div>
        <div class="col md-form md-outline">
            <input type="time" id="begin-picker" name="schedule[begin][]" class="form-control" value="{{ $schedule->begin }}">
            <label for="begin-picker">開始時間</label>
        </div>
        <div class="col md-form md-outline">
            <input type="time" id="end-picker" name="schedule[end][]" class="form-control" value="{{ $schedule->end }}">
            <label for="end-picker">終了時間</label>
        </div>
    </div>
    <div class="form-group">
        <label></label>
        <textarea name="schedule[descripsion][]" class="form-control" rows="3" placeholder="説明">{{ $schedule->descripsion ?? old("schedule.descripsion.$loop->iteration") }}</textarea>
    </div>
    @endforeach
@else

    @for ($i = 0; $i < 2; $i++)
    <div class="form-row">
        <div class="col md-form">
            <label for="new_schedule{{$i}}">スケジュール名</label>
            <input id="new_schedule{{$i}}" type="text" name="schedule[name][]" class="form-control" value="{{ old('schedule.name.$i') }}">
        </div>
        <div class="col md-form md-outline">
            <input type="time" id="begin-picker" name="schedule[begin][]" class="form-control" value="{{ old('schedule.begin.$i') }}">
            <label for="begin-picker">開始時間</label>
        </div>
        <div class="col md-form md-outline">
            <input type="time" id="end-picker" name="schedule[end][]" class="form-control" value="{{ old('schedule.end.$i') }}">
            <label for="end-picker">終了時間</label>
        </div>
    </div>
    <div class="form-group">
        <label></label>
        <textarea name="schedule[descripsion][]" class="form-control" rows="3" placeholder="説明">{{ old("schedule.descripsion.$i") }}</textarea>
    </div>
    @endfor
@endif


@if (isset($event->reservation_seats))
    @foreach ($event->reservation_seats as $reservation_seat)
    <div class="form-row">
        <div class="col md-form">
            <label for="reservation_seat_name{{$loop->iteration}}">定員</label>
            <input id="reservation_seat_name{{$loop->iteration}}" type="text" name="reservation_seat[name][]" class="form-control" value="{{ $reservation_seat->name }}">
        </div>
        <div class="col md-form">
            <label for="reservation_seat_people{{$loop->iteration}}">定員数</label>
            <input id="reservation_seat_people{{$loop->iteration}}" type="number" name="reservation_seat[people][]" class="form-control" value="{{ $reservation_seat->people }}">
        </div>
    </div>
    @endforeach
    @for ($i = 0; $i < (2 - count($event->reservation_seats)); $i++)
    <div class="form-row">
        <div class="col md-form">
            <label for="new_reservation_seat_name{{$i}}">定員</label>
            <input id="new_reservation_seat_name{{$i}}" type="text" name="reservation_seat[name][]" class="form-control" value="">
        </div>
        <div class="col md-form">
            <label for="new_reservation_seat_people{{$i}}">定員数</label>
            <input id="new_reservation_seat_people{{$i}}" type="number" name="reservation_seat[people][]" class="form-control" value="">
        </div>
    </div>
    @endfor
@else
    @for ($i = 0; $i < 2; $i++)
    <div class="form-row">
        <div class="col md-form">
            <label for="new_reservation_seat_name{{$i}}">定員</label>
            <input id="new_reservation_seat_name{{$i}}" type="text" name="reservation_seat[name][]" class="form-control" value="{{ old('reservation_seat.name.$i') }}">
        </div>
        <div class="col md-form">
            <label for="new_reservation_seat_people{{$i}}">定員数</label>
            <input id="new_reservation_seat_people{{$i}}" type="number" name="reservation_seat[people][]" class="form-control" value="{{ old('reservation_seat.people.$i') }}">
        </div>
    </div>
    @endfor
@endif

