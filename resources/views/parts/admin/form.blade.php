@csrf
<div class="md-form">
    <label for="name">管理者名</label>
    <input class="form-control" type="text" id="name" name="name" required value="{{ $admin->name ?? old('name') }}">
</div>
<div class="md-form">
    <label for="email">メールアドレス</label>
    <input class="form-control" type="text" id="email" name="email" required value="{{ $admin->email ?? old('email') }}">
</div>
<div class="md-form">
    <label for="password">パスワード</label>
    <input class="form-control" type="password" id="password" name="password" required>
</div>
<div class="md-form">
    <label for="password_confirmation">パスワード(確認)</label>
    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
</div>