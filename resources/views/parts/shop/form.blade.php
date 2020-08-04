@csrf
<div class="md-form">
    <label>店舗名</label>
    <input type="text" name="name" class="form-control" required value="{{ $shop->name ?? old('name') }}">
</div>

<div class="md-form">
    <label>電話番号</label>
    <input type="text" name="tel" class="form-control" value="{{ $shop->tel ?? old('tel') }}">
</div>

<div class="md-form">
    <label>郵便番号</label>
    <input type="text" name="postcode" class="form-control" value="{{ $shop->postcode ?? old('postcode') }}">
</div>



<div class="form-group">
    <label class="mdb-main-label">都道府県</label>
    <select name="ken" class="browser-default custom-select">

        @include('parts/ken')

    </select>
</div>

<div class="md-form">
    <label>市区郡</label>
    <input type="text" name="city" class="form-control" value="{{ $shop->city ?? old('city') }}">
</div>

<div class="md-form">
    <label>町村以降</label>
    <input type="text" name="block" class="form-control" value="{{ $shop->block ?? old('block') }}">
</div>

<div class="form-group">
    <label></label>
    <textarea name="open" required class="form-control" rows="16" placeholder="営業時間">{{ $shop->open ?? old('open') }}</textarea>
</div>

<div class="md-form">
    <label>定休日</label>
    <input type="text" name="close" class="form-control" value="{{ $shop->close ?? old('close') }}">
</div>

<div class="md-form">
    <label>ホームページ</label>
    <input type="text" name="web" class="form-control" value="{{ $shop->web ?? old('web') }}">
</div>

@if (isset($shop->image_path))
<div class="form-text text-info">
    <p>設定中</p>
    <p>
        <img src="{{ asset('storage/image/shop_images/'.$shop->image_path) }}">
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