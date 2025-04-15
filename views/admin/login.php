<style>
    body {
        background-image: url('https://t3.ftcdn.net/jpg/03/41/31/80/240_F_341318068_0SzEc9byllL4XCZHnrsl4dAnIRagjDta.jpg');
        background-size: auto;
        background-position: center;
        background-repeat: repeat;
    }
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ffffff80;
    }
</style>
<div class="overlay"></div>
<div class="min-h-100 p-0 p-sm-6 d-flex align-items-stretch">
    <div class="card w-25x flex-grow-1 flex-sm-grow-0 m-sm-auto">
        <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
            <h1 class="mb-0 fs-3">Đăng nhập</h1>
            <div class="fs-exact-14 text-muted mt-2 pt-1 mb-5 pb-2">Hệ thống quản lí bưu kiện <?= WEB_NAME ?></div>
            <form action="/dang-nhap" method="post">
                <div class="mb-2">
                    <label class="form-label">Tài khoản</label>
                    <input name="username" type="text" value="<?= $username ?>" class="form-control form-control-lg" />
                </div>
                <div class="mb-2">
                    <label class="form-label">Mật khẩu</label>
                    <input name="password" type="password" class="form-control form-control-lg"
                        autocomplete="new-password" />
                </div>
                <div class="mt-5">
                    <button name="login" type="submit" class="btn btn-primary btn-lg w-100">Đăng nhập</button>
                </div>
            </form>
        </div>
    </div>
</div>