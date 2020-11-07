<input type="hidden" id="prefId" data-pref-id="{{$prefId}}">
<input type="hidden" id="cityId" data-city-id="{{$cityId}}">
<div class="pref-group">
    <label>開催地</label>
    <div class="pref-form-select">
        <select name="pref" id="select-pref" class="form-control pref">
            <option value="">都道府県</option>
        </select>
        <select name="city" id="select-city" class="form-control city">
            <option value="">市区町村郡</option>
        </select>
    </div>
</div>
