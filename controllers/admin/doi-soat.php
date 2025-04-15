<?php

# [MODEL]
model('admin','parcel');

require 'vendor/autoload.php'; // Đảm bảo đường dẫn đúng đến autoload.php của Composer
use PhpOffice\PhpSpreadsheet\IOFactory;


# [VARIABLE]
$result = '';
$list_compare = [];


# [HANDLE]

if (isset($_FILES['file_request'])) {
    $filePath = $_FILES['file_request']['tmp_name'];

    // Đọc dữ liệu từ tệp Excel
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow(); // Lấy số dòng cao nhất

    // Kiểm tra tiêu đề cột
    $expectedHeaders = ['Mã bưu kiện', 'Phí gửi', 'COD', 'Trạng thái mới'];
    $headerRow = $sheet->rangeToArray("A1:D1")[0];

    if ($headerRow === $expectedHeaders) {
        // Nếu tiêu đề đúng, lặp qua từng dòng
        for ($row = 2; $row <= $highestRow; $row++) {
            $data = $sheet->rangeToArray("A$row:D$row")[0]; // Lấy 4 cột

            // Gán dữ liệu vào biến
            $id_parcel = clear_input($data[0]); // Mã bưu kiện
            $new_fee = clear_input($data[1]); // Phí gửi
            $new_cod = clear_input($data[2]); // COD
            $new_state = clear_input($data[3]); // Trạng thái mới

            // Gọi hàm so sánh
            $get_data_compare = compare_parcel($id_parcel, $new_fee, $new_cod, $new_state);
            if($get_data_compare) $list_compare[] = $get_data_compare;
        }
    } else {
        // Thông báo lỗi
        toast_create('danger','File import không đúng địng dạng head : Mã bưu điện | Phí gửi | COD | Trạng thái mới ');
        route('admin/doi-soat');
    }
}

$data = [
    'list_compare' => $list_compare,
];


view('admin','Đối soát','doi-soat',$data);