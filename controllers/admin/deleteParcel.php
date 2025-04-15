<?php

model('admin','parcel');

require 'vendor/autoload.php'; // Đảm bảo đường dẫn đúng đến autoload.php của Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['file_request'])) {
    $filePath = $_FILES['file_request']['tmp_name'];

    // Đọc dữ liệu từ tệp Excel
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow(); // Lấy số dòng cao nhất

    // Kiểm tra tiêu đề cột
    $expectedHeader = ['Mã bưu kiện'];
    $headerRow = $sheet->rangeToArray("A1")[0];

    if ($headerRow === $expectedHeader) {
        // Nếu tiêu đề đúng, lặp qua từng dòng
        for ($row = 2; $row <= $highestRow; $row++) {
            $data = $sheet->rangeToArray("A$row")[0]; // Chỉ lấy cột A
            
            // Gán dữ liệu vào biến
            $id_parcel = trim($data[0]); // Mã bưu kiện

            // Gọi hàm xóa bưu kiện
            delete_parcel_with_id($id_parcel);
        }
        // thông báo và chuyển route
        toast_create('success','Xoá thành công !');
        route('admin/quan-li-buu-kien');
    } else {
        // thông báo và chuyển route
        toast_create('danger','File không đúng bố cục | Mã bưu điện |');
        route('admin/quan-li-buu-kien');
    }
}
