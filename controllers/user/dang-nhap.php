<?php

# [AUTHOR]
// Kiểm tra đã đăng nhập chưa
if(is_login()) route('admin');

# [MODEL]
model('user','user');

# [VARIABLE]
    $username = '';

# [HANDLE]

// Nhấn submit đăng nhập
if(isset($_POST['login'])) {
    // lấy thông tin từ form
    $username = clear_input($_POST['username']);
    $password = clear_input($_POST['password']);

    // Bắt validate
    if(!$username) toast_create('danger','Vui lòng nhập username');
    elseif(!$password) toast_create('danger','Vui lòng nhập mật khẩu');

    // Tiến hành đăng nhập
    else if(login($username,$password)) {
        route('admin');
    }
            
}

# [DATA]
$data = [
    'username' => $username,
];

# [RENDER VIEW]
view('admin','Đăng nhập','login',$data);