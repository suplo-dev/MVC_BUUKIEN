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
    $expectedHeaders = ['Mã bưu kiện', 'Trạng thái mới'];
    $headerRow = $sheet->rangeToArray("A1:B1")[0];

    if ($headerRow === $expectedHeaders) {
        // Nếu tiêu đề đúng, lặp qua từng dòng
        for ($row = 2; $row <= $highestRow; $row++) {
            $data = $sheet->rangeToArray("A$row:B$row")[0]; // Chỉ lấy 2 cột

            
            // Gán dữ liệu vào biến
            $id_parcel = clear_input($data[0]); // Mã bưu kiện
            $new_state = clear_input($data[1]); // Trạng thái mới

            //Bool continue
            $continue = false;

            // Nếu thuộc mảng state
            foreach (ARR_STATE_POST as $state) {
                if (strtolower($state['name']) === strtolower($new_state)) {
                    $continue = true; // Gán true nếu tên trùng khớp
                    break; // Ngừng vòng lặp ngay khi tìm thấy
                }
            }
            
            // Update
            if($continue) update_state_parcel($id_parcel, $new_state);
                
        }
        // thông báo và chuyển route
        toast_create('success','Cập nhật thành công !');
        route('admin/quan-li-buu-kien');
    } else {
        // thông báo và chuyển route
        toast_create('danger','Cột dữ liệu không đúng định dạng | Mã bưu điện | Trạng thái mới |');
        route('admin/quan-li-buu-kien');
    }
}