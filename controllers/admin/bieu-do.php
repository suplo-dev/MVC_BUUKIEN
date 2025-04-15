<?php

author('admin');

# [MODEL]
model('admin','chart');

# [VARIABLE]
$type_show = 'day';
$dateRange = [];
$totalRange = [];
$timeStart = new DateTime();
$timeStart = $timeStart->modify('-'.LIMIT_DAY_LOADED.' day');

# [HANDLE]

// Lấy loại
if(isset($_GET['type_show']) && in_array($_GET['type_show'],['day','week','month','year'])) $type_show = $_GET['type_show'];

// Lấy ngày bắt đầu
if(isset($_GET['time_start']) && is_date($_GET['time_start'])) $timeStart = new DateTime($_GET['time_start']);

// Lấy ngày kết thúc
if(isset($_GET['time_end']) && is_date($_GET['time_end']))  $timeEnd = new DateTime($_GET['time_end']);
else $timeEnd = (clone $timeStart)->modify('+'.LIMIT_DAY_LOADED.' day');


// Show theo ngày
if($type_show == 'day') {

    // đếm số lượng cột theo ngày
    $count_time_line = ($timeStart->diff($timeEnd))->days;
    // Limit
    if($count_time_line > LIMIT_DAY_LOADED) $count_time_line = LIMIT_DAY_LOADED;

    // Tạo mảng timeline
    $dateRange = [];
    $time = clone $timeStart;
    for ($i=0; $i <= $count_time_line;$i++) {
        $dateRange[] = $time->format('Y-m-d');
        $time->modify('+1 day');
    }

    // Lặp theo mảng state
    foreach (ARR_STATE_POST as $state) {
        // Tạo mảng data theo state
        $array_count_state[$state['name']] = [];
        // Lặp theo timeline
        foreach ($dateRange as $date) {
            $array_count_state[$state['name']][] = pdo_query_value(
                'SELECT COUNT(*)
                FROM parcel
                WHERE date_sent = "'.$date.'"
                AND state_parcel = "'.$state['name'].'"'
            );
        }
    }

    // Lặp theo timeline lấy tổng count
    $totalRange = '';
    foreach ($dateRange as $date) {
        $totalRange .= pdo_query_value(
            sql: 'SELECT COUNT(*)
            FROM parcel
            WHERE date_sent = "'.$date.'"'
        ).",";
    }

    //format lại arrayDate
    $format_date_range = '';
    foreach ($dateRange as $date) $format_date_range .= '"'.format_time($date.' 00:00:00','DD Thg MM YYYY').'",';

}

// Show Theo tuần
elseif ($type_show == 'week') {

    // Tạo mảng timeline
    $dateRange = [];
    $time = clone $timeStart;

    // Bắt đầu từ ngày đầu tiên của tuần
    $startWeek = clone $time;
    $startWeek->modify('monday this week');

    // Nếu ngày bắt đầu không phải thứ Hai, tạo mảng từ ngày bắt đầu đến Chủ Nhật
    if ($time->format('N') != 1) {
        $endOfWeek = clone $startWeek;
        $endOfWeek->modify('sunday this week');
        $dateRange[] = [
            'start' => $time->format('Y-m-d'),
            'end' => $endOfWeek->format('Y-m-d')
            ];
        $time = $endOfWeek->modify('+1 day'); // Di chuyển đến ngày tiếp theo
    }

    // Tạo mảng cho các tuần tiếp theo
    while ($time <= $timeEnd) {
        $weekStart = clone $time;
        $weekStart->modify('monday this week');

        $weekEnd = clone $weekStart;
        $weekEnd->modify('sunday this week');

        // Nếu tuần kết thúc lớn hơn ngày kết thúc, điều chỉnh lại
        if ($weekEnd > $timeEnd) {
            $weekEnd = clone $timeEnd;
        }

        $dateRange[] = [
            'start' => $weekStart->format('Y-m-d'),
            'end' => $weekEnd->format('Y-m-d')
            ];

        // Di chuyển đến tuần tiếp theo
        $time = $weekEnd->modify('+1 day'); // Bắt đầu từ ngày tiếp theo
    }

    // test_array($dateRange);

    // Lặp theo mảng state
    foreach (ARR_STATE_POST as $state) {
        // Tạo mảng data theo state
        $array_count_state[$state['name']] = [];
        // Lặp theo timeline
        foreach ($dateRange as $date) {
            $array_count_state[$state['name']][] = pdo_query_value(
                'SELECT COUNT(*)
                FROM parcel
                WHERE date_sent >= "'.$date['start'].'" AND date_sent <= "'.$date['end'].'"
                AND state_parcel = "'.$state['name'].'"'
            );
        }
    }

    // Lặp theo timeline lấy tổng count
    $totalRange = '';
    foreach ($dateRange as $date) {
        $totalRange .= pdo_query_value(
            sql: 'SELECT COUNT(*)
            FROM parcel
            WHERE date_sent >= "'.$date['start'].'" AND date_sent <= "'.$date['end'].'"'
        ).",";
    }

    //format lại arrayDate
    $format_date_range = '';
    foreach ($dateRange as $i => $date) $format_date_range .= '"Tuần '.++$i.' : '.format_time($date['start'].' 00:00:00','DD Thg MM ➔ ').format_time($date['end'].' 00:00:00','DD Thg MM').'",';
}

// Show Theo Tháng
elseif ($type_show == 'month') {

    // Tạo mảng timeline
    $dateRange = [];
    $time = clone $timeStart;

    // Đặt tháng bắt đầu
    $startMonth = clone $time;
    $startMonth->modify('first day of this month');

    // Nếu ngày bắt đầu không phải là ngày đầu tháng, điều chỉnh lại
    if ($time->format('d') != 1) {
        $startMonth = clone $time; // Bắt đầu từ thời điểm hiện tại
    }

    // Tạo mảng cho các tháng
    while ($startMonth <= $timeEnd) {
        $monthStart = clone $startMonth;
        $monthEnd = clone $monthStart;
        $monthEnd->modify('last day of this month');

        // Nếu tháng kết thúc lớn hơn ngày kết thúc, điều chỉnh lại
        if ($monthEnd > $timeEnd) {
            $monthEnd = clone $timeEnd;
        }

        $dateRange[] = [
            'start' => $monthStart->format('Y-m-d'),
            'end' => $monthEnd->format('Y-m-d')
        ];

        // Di chuyển đến tháng tiếp theo
        $startMonth->modify('first day of next month');
    }

    // Lặp theo mảng state
    foreach (ARR_STATE_POST as $state) {
        // Tạo mảng data theo state
        $array_count_state[$state['name']] = [];
        // Lặp theo timeline
        foreach ($dateRange as $date) {
            $array_count_state[$state['name']][] = pdo_query_value(
                'SELECT COUNT(*)
                FROM parcel
                WHERE date_sent >= "'.$date['start'].'" AND date_sent <= "'.$date['end'].'"
                AND state_parcel = "'.$state['name'].'"'
            );
        }
    }

    // Lặp theo timeline lấy tổng count
    $totalRange = '';
    foreach ($dateRange as $date) {
        $totalRange .= pdo_query_value(
            'SELECT COUNT(*)
            FROM parcel
            WHERE date_sent >= "'.$date['start'].'" AND date_sent <= "'.$date['end'].'"'
        ).",";
    }

    // Format lại arrayDate
    $format_date_range = '';
    foreach ($dateRange as $i => $date) {
        $format_date_range .= '"Tháng '.date('m-Y', strtotime($date['start'])).' : '.format_time($date['start'].' 00:00:00','DD Thg MM ➔ ').format_time($date['end'].' 00:00:00','DD Thg MM').'",';
    }
}
// Show theo năm
elseif ($type_show == 'year') {

    // Tạo mảng timeline
    $dateRange = [];
    $time = clone $timeStart;

    // Đặt năm bắt đầu
    $startYear = clone $time;
    $yearStart = clone $startYear;
    $yearStart->modify('first day of January this year');

    // Nếu ngày bắt đầu không phải là ngày đầu năm, điều chỉnh lại
    if ($time->format('m-d') != '01-01') {
        // Sử dụng ngày bắt đầu thực tế
        $yearStart = clone $time; // Bắt đầu từ thời điểm hiện tại
    }

    // Tạo mảng cho các năm
    while ($yearStart <= $timeEnd) {
        $yearEnd = clone $yearStart;
        $yearEnd->modify('last day of December this year');

        // Nếu năm kết thúc lớn hơn ngày kết thúc, điều chỉnh lại
        if ($yearEnd > $timeEnd) {
            $yearEnd = clone $timeEnd;
        }

        $dateRange[] = [
            'start' => $yearStart->format('Y-m-d'),
            'end' => $yearEnd->format('Y-m-d')
        ];

        // Di chuyển đến năm tiếp theo
        $yearStart->modify('first day of January next year');
    }

    // Lặp theo mảng state
    foreach (ARR_STATE_POST as $state) {
        // Tạo mảng data theo state
        $array_count_state[$state['name']] = [];
        // Lặp theo timeline
        foreach ($dateRange as $date) {
            $array_count_state[$state['name']][] = pdo_query_value(
                'SELECT COUNT(*)
                FROM parcel
                WHERE date_sent >= "'.$date['start'].'" AND date_sent <= "'.$date['end'].'"
                AND state_parcel = "'.$state['name'].'"'
            );
        }
    }

    // Lặp theo timeline lấy tổng count
    $totalRange = '';
    foreach ($dateRange as $date) {
        $totalRange .= pdo_query_value(
            'SELECT COUNT(*)
            FROM parcel
            WHERE date_sent >= "'.$date['start'].'" AND date_sent <= "'.$date['end'].'"'
        ).",";
    }

    // Format lại arrayDate
    $format_date_range = '';
    foreach ($dateRange as $i => $date) {
        $format_date_range .= '"Năm '.date('Y', strtotime($date['start'])).' : '.format_time($date['start'].' 00:00:00','DD Thg MM ➔ ').format_time($date['end'].' 00:00:00','DD Thg MM').'",';
    }
}

$format_data_count = "["; // Start JSON array
foreach (ARR_STATE_POST as $state) {
    $array_value = implode(",", $array_count_state[$state['name']]); // Convert array to comma-separated values
    $format_data_count .= '
    {
        "label": "'.$state['name'].'",
        "data": ['.$array_value.'],
        "backgroundColor": "'.$state['color'].'",
        "borderColor": "'.$state['color'].'",
        "borderWidth": 1,
        "width": '.match ($type_show) {
            'day' => 0.3,
            'week' => 0.5,
            'month' => 0.7,
            'year' => 0.9,
        }.'
    },';
}
$format_data_count = rtrim($format_data_count, ","); // Remove last comma
$format_data_count .= "]"; // End JSON array

# [DATA]
$data = [
    'type_show' => $type_show,
    'timeStart' => $timeStart,
    'timeEnd' => $timeEnd,
    'arrayCount' => $format_data_count,
    'arrayDate' => substr($format_date_range,0,-1),
    'arrayTotal' => substr($totalRange,0,-1),
];

# [RENDER]
view('admin','Thống kê','dashboard',$data);
