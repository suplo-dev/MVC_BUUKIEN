<?php

# [AUTHOR]

# [MODEL]
model('admin','parcel');
model('admin','employee');

# [VARIABLE]
$error_valid = []; // mảng lỗi valid
$show_modal = '';
$id_parcel = $brand_post = $id_user = $date_sent = $name_receiver = $phone_receiver = $address_receiver = $note = $state_parcel = $name_product = '';
$fee = $cod = 0;

# [HANDLE]

// Lấy theo id
if(isset($_GET['id'])) {

    // lấy id
    $id = clear_input($_GET['id']);
    // lấy row
    $get = get_parcel_with_id($id);

    view_json(200,[
        'data' => $get,
    ]);
}else view_error(404);