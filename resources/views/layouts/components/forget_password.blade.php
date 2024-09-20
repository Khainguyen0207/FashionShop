
<div id="auth">
    <div id="forget_password">
        <a href="" class="btn btn-back" style="margin:10px 0;">Quay lại</a>
        <h2 style="margin-bottom: 10px; border-bottom: 1px solid lightgray">Quên mật khẩu</h2>
        <form action="/helloword" method="post">
            @csrf
            <label for="mail_label">Email</label>
            <div class="mail">
                <input type="text" name="" id="" value="tkhai12386@gmail.com" readonly>
                <a href="" class="btn btn-back" >Gửi mã</a>
            </div>
            <label for="code_label">Mã xác nhận</label>
            <div class="code">
                <input type="text" name="1" id="code" maxlength="1">
                <input type="text" name="2" id="code" maxlength="1">
                <input type="text" name="3" id="code" maxlength="1">
                <input type="text" name="4" id="code" maxlength="1">
            </div>
            <button type="submit" id="btn_code_confirm" enable>Xác nhận</button>
        </form>
    </div>
</div>
<script>updateEventChange()</script>