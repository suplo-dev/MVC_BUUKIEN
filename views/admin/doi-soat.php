<!-- sa-app__body -->
<div id="top" class="sa-app__body">
    <div class="pb-5">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="sa-divider"></div>
                <!-- <table class="sa-datatables-init table table-hover border-muted" data-order="[[ 9, &quot;asc&quot; ]]" data-sa-search-input="#table-search"> -->
                <table id="dataTable" class="table table-hover border-muted mb-5">
                    <thead>
                        <tr class="small">
                            <!-- <th class="w-min">ID</th> -->
                            <th class="col-1 text-center">Mã bưu kiện</th>
                            <th class="col-1 text-center">Phí gửi cũ</th>
                            <th class="col-1 text-center">Phí gửi mới</th>
                            <th class="col-1 text-center">COD cũ</th>
                            <th class="col-1 text-center">COD mới</th>
                            <th class="col-2 text-center">Trạng thái cũ</th>
                            <th class="col-2 text-center">Trạng thái mới</th>
                            <th class="col-3 text-center">Nguyên nhân</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if($list_compare) : ?>
                        <?php foreach ($list_compare as $item) : extract($item)?>
                            <tr class="small <?= $reason && $reason != 'Thay đổi trạng thái' ? 'bg-error' : '' ?>">
                                <td class="small align-middle text-center">
                                    <?= $id_parcel ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $old_fee ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $new_fee ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $old_cod ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $new_cod ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $old_state ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $new_state ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $reason ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        <?php else : ?>
                            <tr class="small text-center align-middle">
                                <td colspan="8">
                                    <span class="text-muted">Vui lòng nhấn button <span class="text-primary fw-bold">Tải XLSX ở phía trên</span> để dùng chức năng.</span>
                                    <br>
                                    <span class="text-danger">Lưu ý :</span> File phải đúng định dạng head : <span class="fw-bold">Mã bưu kiện <span class="text-muted fw-semi">|</span> Phí gửi <span class="text-muted fw-semi">|</span> COD <span class="text-muted fw-semi">|</span> Trạng thái mới</span>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('printDoiSoat').addEventListener('click', function() {
        // Lấy dữ liệu từ bảng
        var table = document.getElementById('dataTable');
        
        // Kiểm tra xem bảng có dữ liệu hay không
        if (table.querySelector('tbody tr')) {
            var workbook = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });

            // Đặt độ rộng cho các cột
            var ws = workbook.Sheets["Sheet1"];
            ws['!cols'] = [
                { wpx: 100 },
                { wpx: 100 },
                { wpx: 100 },
                { wpx: 100 },
                { wpx: 100 },
                { wpx: 100 },
                { wpx: 100 },
                { wpx: 200 } 
            ];

            // Tạo thời gian
            var now = new Date();
            var formattedDate = [
                String(now.getDate()).padStart(2, '0'),
                String(now.getMonth() + 1).padStart(2, '0'),
                now.getFullYear(),
                String(now.getHours()).padStart(2, '0'),
                String(now.getMinutes()).padStart(2, '0'),
                String(now.getSeconds()).padStart(2, '0')
            ].join('_');

            // Tải file Excel
            XLSX.writeFile(workbook, 'du_lieu_doi_soat' + formattedDate + '.xlsx');
        } else {
            alert('Không có dữ liệu để xuất.');
        }
    });
</script>