<div id="auth">
    <div id="change_password">
        <a href="" class="btn btn-back" style="margin:10px 0;">Quay lại</a>
        <form action="/helloword" method="post">
            <h2 style="margin-bottom: 10px; border-bottom: 1px solid lightgray">Thay đổi mật khẩu</h2>
            @csrf
            <label for="old_password">Mật khẩu cũ</label>
            <input type="password" name="old_password" id="old_password">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" name="new_password" id="new_password">
            <label for="password_confirm">Xác nhận lại mật khẩu</label>
            <input type="password" name="password_confirm" id="password_confirm">
            <button type="submit" class="btn btn-save" style="margin-top: 10px;">Thay đổi</button>
        </form>
    </div>
</div>