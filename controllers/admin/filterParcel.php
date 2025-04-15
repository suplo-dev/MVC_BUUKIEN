<?php

# [MODEL]
model('admin','render_parcel');

# [VARIABLE]
$render_data = ''; // dữ liệu parcel
$query_post_parcel = 'IS NOT NULL';
$query_start_date = $query_end_date = $query_filter_state = '';
$number_page = 1; // trang

if(isset($_GET['keyword'])) {

    // keyword
    $keyword = clear_input($_GET['keyword']);
    $keyword = '"%'.$keyword.'%"';

    // postParcel
    if(isset($_GET['postParcel']) && $_GET['postParcel']) {
        $query_post_parcel = '= "'.clear_input($_GET['postParcel']).'"';
    }

    //date start
    if(isset($_GET['start_date']) && $_GET['start_date']) {
        $query_start_date = 'AND date_sent >= "'.clear_input($_GET['start_date']).'"';
    }

    //date end
    if(isset($_GET['end_date']) && $_GET['end_date']) {
        $query_end_date = 'AND date_sent <= "'.clear_input($_GET['end_date']).'"';
    }

    //trạng thái
    if(isset($_GET['filterState']) && $_GET['filterState']) {
        $query_filter_state = 'AND state_parcel = "'.clear_input($_GET['filterState']).'"';
    }

    // query count
    $total_row = pdo_query_value(
        'SELECT COUNT(*)
        FROM parcel
        WHERE brand_post '.$query_post_parcel.'
        '.$query_start_date.'
        '.$query_end_date.'
        '.$query_filter_state.'
        AND (
            id_parcel LIKE '.$keyword.'
            OR username LIKE '.$keyword.'
            OR date_sent LIKE '.$keyword.'
            OR name_receiver LIKE '.$keyword.'
            OR phone_receiver LIKE '.$keyword.'
            OR address_receiver LIKE '.$keyword.'
            OR province_receiver LIKE '.$keyword.'
            OR fee LIKE '.$keyword.'
            OR cod LIKE '.$keyword.'
            OR name_product LIKE '.$keyword.'
            OR note LIKE '.$keyword.'
            OR state_parcel LIKE '.$keyword.'
        )
        ORDER BY created_at ASC'
    );

    // paginate
    // lấy số trang request
    if(isset($_GET['paginate']) && $_GET['paginate']) $number_page = $_GET['paginate'];

    // render paginate
    $render_paginate = render_paginate_parcel($total_row,$number_page);
    // query paginate
    $query_paginate = 'LIMIT '.($number_page - 1) * LIMIT_ROW_PAGINATE.', '.LIMIT_ROW_PAGINATE;

    // query với paginate
    $query = pdo_query(
        'SELECT *
        FROM parcel
        WHERE brand_post '.$query_post_parcel.'
        '.$query_start_date.'
        '.$query_end_date.'
        '.$query_filter_state.'
        AND (
            id_parcel LIKE '.$keyword.'
            OR username LIKE '.$keyword.'
            OR date_sent LIKE '.$keyword.'
            OR name_receiver LIKE '.$keyword.'
            OR phone_receiver LIKE '.$keyword.'
            OR address_receiver LIKE '.$keyword.'
            OR province_receiver LIKE '.$keyword.'
            OR fee LIKE '.$keyword.'
            OR cod LIKE '.$keyword.'
            OR name_product LIKE '.$keyword.'
            OR note LIKE '.$keyword.'
            OR state_parcel LIKE '.$keyword.'
        )
        ORDER BY created_at ASC '.
        $query_paginate
    );

    //render
    if(empty($query)) $render_data .= render_row_empty();
    foreach ($query as $item) {
        $render_data .= render_row_parcel($item);
    }


    //return
    view_json(200,[
        'count' => count($query),
        'number_page' => $number_page,
        'paginate' => $render_paginate,
        'data' => $render_data,
    ]);
}