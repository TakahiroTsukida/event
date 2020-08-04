<div class="md-form">
    <label for="name">ユーザー名</label>
    <input class="form-control" type="text" id="name" name="name" required value="{{ $user->name ?? old('name') }}">
</div>

<div class="text-left">
    <!-- Default inline 1-->
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="defaultInline1" name="gender" value="0" @if(isset($user->gender)) {{ $user->gender == '0' ? 'checked' : ''}} @else {{ old('gender') == '0' ? 'checked' : ''}} @endif>
        <label class="custom-control-label" for="defaultInline1">男性</label>
    </div>

    <!-- Default inline 2-->
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="defaultInline2" name="gender" value="1" @if(isset($user->gender)) {{ $user->gender == '1' ? 'checked' : ''}} @else {{ old('gender') == '1' ? 'checked' : ''}} @endif>
        <label class="custom-control-label" for="defaultInline2">女性</label>
    </div>
</div>

<div class="md-form">
    <input type="date" id="birthday" name="birthday" class="form-control" value="{{ $user->birthday ?? old('birthday') }}">
    <label for="birthday">生年月日</label>
</div>

<div class="form-group">
    <textarea name="introduction" class="form-control" rows="16" placeholder="自己紹介">{{ $user->introduction ?? old('introduction') }}</textarea>
</div>