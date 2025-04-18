<?php

model('admin', 'parcel');

require 'vendor/autoload.php'; // Đảm bảo đường dẫn đúng đến autoload.php của Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['file_request']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    $filePath = $_FILES['file_request']['tmp_name'];

    // Đọc dữ liệu từ tệp Excel
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow(); // Lấy số dòng cao nhất

    // Kiểm tra tiêu đề cột
    $expectedHeaders = [
        'Mã bưu kiện',
        'Chuyển phát',
        'Mã nhân viên',
        'Ngày gửi',
        'Người nhận',
        'Điện thoại',
        'Địa chỉ',
        'Phí gửi',
        'COD',
        'Sản phẩm',
        'Trạng thái',
        'Ghi chú'
    ];

    // Lấy tiêu đề cột
    $headerRow = $sheet->rangeToArray("A1:L1")[0];

    if ($headerRow === $expectedHeaders) {
        // Nếu tiêu đề đúng, lặp qua từng dòng
        for ($row = 2; $row <= $highestRow; $row++) {
            //Bool continue
            $continue = false;
            // Sắp xếp
            $data = $sheet->rangeToArray("A$row:L$row")[0];


            // Nếu thuộc mảng brand
            if (in_array($data[1], ARR_POST_BRAND)) {
                // Nếu thuộc mảng state
                foreach (ARR_STATE_POST as $state) {
                    if ($state['name'] === trim($data[10])) {
                        $continue = true; // Gán true nếu tên trùng khớp
                        break; // Ngừng vòng lặp ngay khi tìm thấy
                    }
                }
            }


            if ($continue) {
                // Gán dữ liệu vào biến
                $id_parcel = clear_input($data[0]);
                $brand_post = clear_input($data[1]);
                $id_user = clear_input($data[2]);
                if ($data[3]) {
                    $array_date = explode('/', $data[3]);
                    if (strlen($array_date[1]) == 1)
                        $array_date[1] = '0' . $array_date[1];
                    if (strlen($array_date[0]) == 1)
                        $array_date[0] = '0' . $array_date[0];
                    $date_sent = clear_input($array_date[2] . '-' . $array_date[0] . '-' . $array_date[1]);
                } else
                    $date_sent = null;
                $name_receiver = clear_input($data[4]);
                $phone_receiver = clear_input($data[5]);
                $address_receiver = clear_input($data[6]);
                (is_numeric($data[7])) ? $fee = clear_input($data[7]) : $fee = null;
                (is_numeric($data[8])) ? $cod = clear_input($data[8]) : $cod = null;
                $name_product = clear_input($data[9]);
                $state_parcel = clear_input($data[10]);
                $note = clear_input($data[11]);

                // Kiểm tra nếu chưa tồn tại tồn tại
                if (empty(get_parcel_with_id($data[0]))) {
                    // Gọi hàm tạo bưu kiện
                    create_parcel($id_parcel, $brand_post, $id_user, $date_sent, $name_receiver, $phone_receiver, $address_receiver, null, $fee, $cod, $name_product, $state_parcel, $note);
                }
                // Cập nhật
                else {
                    // Gọi hàm tạo bưu kiện
                    update_parcel(true,$id_parcel, $brand_post, $id_user, $date_sent, $name_receiver, $phone_receiver, $address_receiver, null, $fee, $cod, $note, $state_parcel);
                }
            }

        }
        // thông báo và chuyển route
        toast_create('info', 'Quá trình nhập XLSX đã hoàn tất.');
        route('admin/quan-li-buu-kien');
    } else {
        // thông báo và chuyển route
        toast_create('danger', 'File import không đúng định dạng dòng head : Mã bưu kiện | Chuyển phát | Mã nhân viên | Ngày gửi | Người nhận | Điện thoại | Địa chỉ | Phí gửi | COD | Sản phẩm | Trạng thái | Ghi chú');
        route('admin/quan-li-buu-kien');
    }
}

view_error(404);
