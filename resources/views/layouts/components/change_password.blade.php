<div id="change_password">
    <form action="" method="post">
        @csrf
        <label for="old_password">Mật khẩu cũ</label>
        <input type="password" name="old_password" id="old_password">
        <label for="new_password">Mật khẩu mới</label>
        <input type="password" name="new_password" id="new_password">
        <label for="password_confirm">Xác nhận lại mật khẩu</label>
        <input type="password" name="password_confirm" id="password_confirm">
        <button type="submit" class="btn btn-save"></button>
    </form>
</div>