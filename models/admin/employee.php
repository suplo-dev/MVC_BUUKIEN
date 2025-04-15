<?php

function get_all_employee() {
    return pdo_query(
        'SELECT u.id_user, u.code_user, u.full_name, u.phone, u.username, u.id_role, r.name_role
        FROM user u
        JOIN role r ON u.id_role = r.id_role'
    );
}

function get_one_employee_by_id($id) {
    return pdo_query_one(
        'SELECT u.id_user, u.code_user, u.full_name, u.phone, u.username, u.id_role, r.name_role
        FROM user u
        JOIN role r ON u.id_role = r.id_role
        WHERE u.id_user = "'.$id.'"'
    );
}

/**
 * Kiểm tra username đã tồn tại chưa
 * 
 * Trả về TRUE nếu tồn tại, FALSE là chưa tồn tại
 */
function check_exist_employee($username) {
    return pdo_query_value(
        'SELECT id_user 
        FROM user
        WHERE username = "'.$username.'"'
    );
}

function create_employee($code_user, $id_role,$full_name,$phone,$username,$password) {
    // mã hoá mật khẩu
    $password = md5($password);
    // thực thi sql
    pdo_execute(
        "INSERT INTO user (code_user,id_role,full_name,phone,username,password)
        VALUES (
        '".$code_user."',
        ".$id_role.",
        '".$full_name."',
        '".$phone."',
        '".$username."',
        '".$password."'
        )
    ");
}

/**
 * Kiểm tra tồn tại username khi update
 * @param mixed $username
 * @return bool Trả về true nếu tồn tại, false nếu không tồn tại
 */
function check_exist_username_update($username,$username_old) {
    $query = pdo_query_value(
        'SELECT username 
        FROM user
        WHERE username = "'.$username.'"'
    );
    if($query && $query != $username_old) return true;

    return false;

}

/**
 * Kiểm tra tồn tại id_user (employee code) khi update
 * @param mixed $id
 * @return bool Trả về true nếu tồn tại, false nếu không tồn tại
 */
function check_exist_code_user_update($code_user,$code_user_old) {
    $query = pdo_query_value(
        'SELECT code_user 
        FROM user
        WHERE code_user = "'.$code_user.'"'
    );
    
    // nếu tồn tại
    if($query && $query != $code_user_old) return true;
    return false;

}

function update_employee($id_user,$code_user, $id_role,$full_name,$phone,$username,$password) {
    // mã hoá mật khẩu
    if($password) {
        $password = md5($password);
        $change_password = ", password = '".$password."'";
    }else $change_password = "";
    

    // thực thi sql
    pdo_execute(
        "UPDATE user
        SET
        code_user = '".$code_user."',
        id_role = ".$id_role.",
        full_name = '".$full_name."',
        phone = '".$phone."',
        username = '".$username."'".
        $change_password."
        WHERE id_user = '".$id_user."'"
    );
}

function get_all_employee_with_filter($keyword) {
    
    return pdo_query(
        'SELECT u.id_user, u.code_user, u.full_name, u.phone, u.username, u.id_role, r.name_role
        FROM user u
        JOIN role r ON u.id_role = r.id_role
        WHERE u.full_name LIKE "%'.$keyword.'%"'
    );
}