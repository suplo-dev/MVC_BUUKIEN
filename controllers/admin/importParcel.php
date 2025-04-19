<?php

model('admin', 'parcel');

require 'vendor/autoload.php'; // Đảm bảo đường dẫn đúng đến autoload.php của Composer

use PhpOffice\PhpSpreadsheet\IOFactory;
echo '<pre>';
$t1 = microtime(true);
if (isset($_FILES['file_request']) && $_FILES['file_request']['error'] == UPLOAD_ERR_OK) {
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
    $t2 = microtime(true);
    var_dump($t2 - $t1);
    if ($headerRow === $expectedHeaders) {
        $arrData = [];
        // Nếu tiêu đề đúng, lặp qua từng dòng
        for ($row = 2; $row <= $highestRow; $row++) {
            $t3 = microtime(true);
            // Sắp xếp và lấy dữ liệu dòng hiện tại
            $data = $sheet->rangeToArray("A$row:L$row")[0];

            // Kiểm tra tiêu chí đầu vào
            $continue = false;
            if (in_array($data[1], ARR_POST_BRAND)) {
                foreach (ARR_STATE_POST as $state) {
                    if ($state['name'] === trim($data[10])) {
                        $continue = true; // Gán true nếu tên trùng khớp
                        break; // Ngừng vòng lặp ngay khi tìm thấy
                    }
                }
            }

            // Nếu dữ liệu hợp lệ, thêm vào mảng arrData
            if ($continue) {
                // Xử lý dữ liệu
                $id_parcel = clear_input($data[0]);
                $brand_post = clear_input($data[1]);
                $id_user = clear_input($data[2]);

                // Xử lý ngày gửi nếu có
                $date_sent = null;
                if ($data[3]) {
                    $array_date = explode('/', $data[3]);
                    $array_date[1] = str_pad($array_date[1], 2, '0', STR_PAD_LEFT);
                    $array_date[0] = str_pad($array_date[0], 2, '0', STR_PAD_LEFT);
                    $date_sent = clear_input($array_date[2] . '-' . $array_date[0] . '-' . $array_date[1]);
                }

                // Lấy các giá trị khác
                $name_receiver = clear_input($data[4]);
                $phone_receiver = clear_input($data[5]);
                $address_receiver = clear_input($data[6]);
                $fee = is_numeric($data[7]) ? clear_input($data[7]) : null;
                $cod = is_numeric($data[8]) ? clear_input($data[8]) : null;
                $name_product = clear_input($data[9]);
                $state_parcel = clear_input($data[10]);
                $note = clear_input($data[11]);

                // Thêm dữ liệu vào mảng arrData
                $arrData[] = [
                    $id_parcel, $brand_post, $id_user, $date_sent, $name_receiver, $phone_receiver,
                    $address_receiver, null, $fee, $cod, $name_product, $state_parcel, $note, date("Y-m-d H:i:s")
                ];
            }
            $t4 = microtime(true);
            var_dump('4-3', $t4 - $t3);
            // Xử lý khi mảng arrData có hơn 1000 dòng
            if (count($arrData) >= 1000) {
                foreach (array_chunk($arrData, 1000) as $chunk) {
                    delete_parcels(implode("','", array_column($chunk, 0))); // Lấy id_parcel từ chunk
                    $values = str_repeat('?,', count($chunk[0]) - 1) . '?';
                    $sql = "INSERT INTO parcel (id_parcel, brand_post, username, date_sent, name_receiver, phone_receiver, 
                            address_receiver, province_receiver, fee, cod, name_product, state_parcel, note, created_at)
                            VALUES " . str_repeat("($values),", count($chunk) - 1) . "($values)";

                    $conn = pdo_get_connection();
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array_merge(...$chunk)); // Chèn dữ liệu vào database
                }
                // Reset arrData sau khi xử lý
                $arrData = [];
                $t5 = microtime(true);
                var_dump('5-4', $t5 - $t4);
            }
        }

        // Xử lý các dữ liệu còn lại nếu có
        if (!empty($arrData)) {
            foreach (array_chunk($arrData, 1000) as $chunk) {
                delete_parcels(implode("','", array_column($chunk, 0)));
                $values = str_repeat('?,', count($chunk[0]) - 1) . '?';
                $sql = "INSERT INTO parcel (id_parcel, brand_post, username, date_sent, name_receiver, phone_receiver, 
                        address_receiver, province_receiver, fee, cod, name_product, state_parcel, note, created_at)
                        VALUES " . str_repeat("($values),", count($chunk) - 1) . "($values)";

                $conn = pdo_get_connection();
                $stmt = $conn->prepare($sql);
                $stmt->execute(array_merge(...$chunk));
            }
        }
        $t6 = microtime(true);
        var_dump('end', $t6 - $t1);

        echo '</pre>';

        // Thông báo hoàn tất và chuyển route
        toast_create('info', 'Quá trình nhập XLSX đã hoàn tất.');
        route('admin/quan-li-buu-kien');
    } else {
        // Thông báo lỗi nếu tiêu đề không khớp
        toast_create('danger', 'File import không đúng định dạng dòng head: Mã bưu kiện | Chuyển phát | Mã nhân viên | Ngày gửi | Người nhận | Điện thoại | Địa chỉ | Phí gửi | COD | Sản phẩm | Trạng thái | Ghi chú');
        route('admin/quan-li-buu-kien');
    }
}


view_error(404);
