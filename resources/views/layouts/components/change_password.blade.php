<div id="auth">
    <div id="change_password">
        <a href="" class="btn btn-back" style="margin:10px 0;">Quay lại</a>
        <form action="{{ route("profile.change") }}" method="post">
            <h2 style="margin-bottom: 10px; border-bottom: 1px solid lightgray">Thay đổi mật khẩu</h2>
            @csrf
            <label for="old_password">Mật khẩu cũ</label>
            <input type="password" name="old_password" id="old_password" required>
            <label for="password">Mật khẩu mới</label>
            <input type="password" name="password" id="password" required>
            <label for="password_confirmation">Xác nhận lại mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            <button type="submit" class="btn btn-save" style="margin-top: 10px;">Thay đổi</button>
        </form>
    </div>
</div>