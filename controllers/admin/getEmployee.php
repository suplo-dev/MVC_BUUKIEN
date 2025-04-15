<?php

# [AUTHOR]
author('admin');

# [MODEL]
model('admin','employee');

# [VARIABLE]

# [HANDLE]


# Lấy danh sách
if(isset($_GET['filter'])) {
    // lấy input
    $keyword = clear_input($_GET['filter']);
    
    view_json(200,[
        'data' => get_all_employee_with_filter($keyword),
    ]);
}


# Lấy theo id
if(isset($_GET['id']) && $_GET['id']) {
    
    // lấy input
    $request_id = $_GET['id'];

    // query
    $query = get_one_employee_by_id($request_id);

    // nếu hợp lệ
    if ($query) view_json(200,['data' => $query]);
}

view_json(404,['message' => 'Not found employee id_request']);