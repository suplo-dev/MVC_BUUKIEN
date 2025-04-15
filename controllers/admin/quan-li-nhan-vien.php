<?php

author('admin');

# [MODEL]
model('admin','employee');

# [VARIABLE]
$username = $full_name = $phone = $id_role = $id_user = $code_user = $show_modal = '';
$error_valid = [];

# [HANDLE]
// Thêm nhân viên mới
if(isset($_POST['addEmployee']) || isset($_POST['editEmployee'])) {
    
    // lấy input
    if(isset($_POST['code_user'])) $code_user = clear_input($_POST['code_user']);
    if(isset($_POST['id_role'])) $id_role = clear_input($_POST['id_role']);
    if(isset($_POST['full_name'])) $full_name = clear_input($_POST['full_name']);
    if(isset($_POST['phone'])) $phone = clear_input($_POST['phone']);
    if(isset($_POST['username'])) $username = clear_input($_POST['username']);
    if(isset($_POST['password'])) $password = clear_input($_POST['password']);

    // validate
    if(!$id_role) $error_valid[] = 'Vui lòng chọn phân quyền';
    if(!$code_user) $error_valid[] = 'Vui lòng nhập mã nhân viên';
    if(!$full_name) $error_valid[] = 'Vui lòng nhập họ tên';
    if(!$phone) $error_valid[] = 'Vui lòng nhập số điện thoại';
    if(!$username) $error_valid[] = 'Vui lòng nhập username';
    
    if(isset($_POST['addEmployee'])) {
        
        // Validate
        if(!$password) $error_valid[] = 'Vui lòng nhập mật khẩu';
        if(check_exist_employee($username)) $error_valid[] = 'Username này đã tồn tại';
        if(get_one_employee_by_id($code_user)) $error_valid[] = 'Mã nhân viên này đã tồn tại';

        // nếu hợp lệ
        if (empty($error_valid)) {
            // insert
            create_employee($code_user,$id_role,$full_name,$phone,$username,$password);
            // thông báo
            toast_create('success','Thêm mới thành công');
            // chuyển route
            route('admin/quan-li-nhan-vien');
        }
        // báo lỗi
        else $show_modal = 'modalAddEmployee'; // bật modal lên
    }

    if(isset($_POST['editEmployee'])) {

        // input
        if(isset($_POST['id_user'])) $id_user = clear_input($_POST['id_user']);
        
        // query
        $get_user = get_one_employee_by_id($id_user);

        // Validate
        if(!$get_user) $error_valid[] = 'User này không tồn tại';
        // nếu là đang update cho QTV
        elseif($get_user['username'] == 'admin') {
            // nếu không phải là QTV
            if(auth('username') != 'admin') {
                toast_create('danger','Không thể cập nhật cho ADMIN');
                route('admin/quan-li-nhan-vien');
            }
            // Cố định username
            else $username = 'admin';
        }

        if(check_exist_username_update($username,$get_user['username'])) $error_valid[] = 'Username này đã tồn tại';
        if(check_exist_code_user_update($code_user,$get_user['code_user'])) $error_valid[] = 'Mã nhân viên này đã tồn tại';

        // nếu hợp lệ
        if (empty($error_valid)) {
            // insert
            update_employee($id_user,$code_user,$id_role,$full_name,$phone,$username,$password);
            // thông báo
            toast_create('success','Cập nhật thành công');
            // chuyển route
            route('admin/quan-li-nhan-vien');
        }
        // báo lỗi
        else $show_modal = 'modalEditEmployee'; // bật modal lên

    }
}

// Xoá nhân viên
if(isset($_POST['deleteEmployee']) && isset($_POST['id']) && $_POST['id']) {
    /// input
    $id = clear_input($_POST['id']);
    // get
    $get = get_one_employee_by_id($id);
    
    //validate
    if(!$get) toast_create('danger','User này không tồn tại');
    elseif($get['username'] == 'admin') toast_create('danger','Không thể xoá tài khoản admin');

    //delete
    else {
        delete_force_one('user',$id);
        toast_create('success','Xoá thành công user');
    }
    
    // chuyển route
    route('admin/quan-li-nhan-vien');
}

# [DATA]
$data = [
    'code_user' => $code_user,
    'id_role' => $id_role,
    'id_user' => $id_user,
    'full_name' => $full_name,
    'phone' => $phone,
    'username' => $username,
    'show_modal' => $show_modal,
    'error_valid' => $error_valid,
    'list_employee' => get_all_employee(),
];

# [RENDER]
view('admin','Quản lí nhân viên','nhan-vien',$data);