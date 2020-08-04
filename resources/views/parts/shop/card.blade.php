
<table class="table table-bordered">

    <thead>
        <tr>
            <th>店舗名</th>
            <th>{{ $shop->name }}</th>
        </tr>
    </thead>

    <tbody>
        @if (isset($shop->image_path))
        <tr>
            <td>画像</td>
            <td>
                <p>
                    <img src="{{ asset('storage/image/shop_images/'.$shop->image_path) }}">
                </p>
            </td>
        </tr>
        @endif

        @if (isset($shop->tel))
        <tr>
            <td>電話番号</td>
            <td><a href="tel:{{ $shop->tel }}" style="color: blue;">{{ $shop->tel }}</a></td>
        </tr>
        @endif

        <tr>
            <td>住所</td>
            <td>
                @if (isset($shop->postcode))
                    〒{{ $shop->postcode }}<br>
                @endif
                {{ $shop->ken }} {{ isset($shop->city) ? $shop->city : "" }} {{ isset($shop->block) ? $shop->block : "" }}
            </td>
        </tr>
        
        <tr>
            <td>営業時間</td>
            <td>{!! nl2br(e($shop->open)) !!}</td>
        </tr>
        
        @if (isset($shop->close))
        <tr>
            <td>定休日</td>
            <td>{{ $shop->close }}</td>
        </tr>
        @endif

        @if (isset($shop->web))
        <tr>
            <td>ホームページ</td>
            <td>{{ $shop->web }}</td>
        </tr>
        @endif

    </tbody>
</table>