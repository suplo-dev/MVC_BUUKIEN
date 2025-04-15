<!-- sa-app__body -->
<div id="top" class="sa-app__body">
    <div class="pb-5">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="sa-divider"></div>
                <!-- <table class="sa-datatables-init table table-hover border-muted" data-order="[[ 9, &quot;asc&quot; ]]" data-sa-search-input="#table-search"> -->
                <table id="dataTable" class="table table-striped table-hover border-muted mb-5">
                    <thead>
                        <tr class="small">
                            <!-- <th class="w-min">ID</th> -->
                            <th class="col-1 text-center">Mã bưu kiện</th>
                            <th class="col-1 text-center">Chuyển phát</th>
                            <th class="col-1 text-center">Mã nhân viên</th>
                            <th class="col-1 text-center">Ngày gửi</th>
                            <th class="col-1 text-center">Người nhận</th>
                            <th class="col-1 text-center">Điện thoại</th>
                            <th class="col-1 text-center">Địa chỉ</th>
                            <th class="col-1 text-center">Phí gửi</th>
                            <th class="col-1 text-center">COD</th>
                            <th class="col-1 text-center">Sản phẩm</th>
                            <th class="col-1 text-center">Trạng thái</th>
                            <th class="col-1 text-center">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody id="resultParcel">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer Page -->
<div class="position-fixed fixed-bottom d-flex bg-primary">
    <div class="container-fluid d-flex px-0 py-3">
        <div class="col-1 invisible">
            space
        </div>

        <div class="col-1">
            <select name="filterPostParcel" class="form-select form-select-sm border-0 bg-blue-light text-light rounded-0">
                <option value="0" selected >- Lọc đơn vị -</option>
                <?php foreach (ARR_POST_BRAND as $i => $name): ?>
                    <option value="<?= $name ?>"><?= $name ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="col-1 invisible">
            space
        </div>

        <div class="col-1">
            <div class="dropdown sa-toolbar__item">
                <button class="sa-toolbar-user btn-sm bg-primary small fw-normal bg-blue-light text-light rounded-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    data-bs-offset="0,1" aria-expanded="false">
                    - Lọc ngày gửi -
                </button>
                <ul style="width: 360px !important" class="dropdown-menu p-5" aria-labelledby="dropdownMenuButton">
                    <li>
                        <div class="">
                            <div class="input-group mb-3">
                                <span class="input-group-text w-25">
                                    <small>Từ ngày</small>
                                </span>
                                <input name="start_date" type="date" class="form-control" placeholder="Username" aria-label="Username">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text w-25">
                                    <small>Đến ngày</small>
                                </span>
                                <input name="end_date" type="date" class="form-control" placeholder="Username" aria-label="Username">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-6 d-flex justify-content-between align-items-center px-5">
            <div id="resultPaginate" class="d-flex gap-2">
                <button value="0" class="sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light-disabled">
                    <small>Trước</small>
                </button>
                <button value="0" class="sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light-active">
                    <small>1</small>
                </button>
                <button value="2" class="sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light">
                    <small>2</small>
                </button>
                <button value="3" class="sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light">
                    <small>3</small>
                </button>
                <button value="2" class="sa-toolbar-user btn-sm bg-primary small fw-normal text-light rounded-0 bg-blue-light">
                    <small>Sau</small>
                </button>
            </div>
            <div class="small text-light">
                <small>Số dòng của trang này : <span id="resultCount"></span></small>
            </div>
        </div>

        <div class="col-1">
            <select name="filterState" class="form-select form-select-sm border-0 bg-blue-light text-light rounded-0">
                <option value="0" selected>- Lọc trạng thái -</option>
                <?php foreach (ARR_STATE_POST as $i => $item): extract($item)?>
                    <option value="<?= $name ?>"><?= $name ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
</div>

<!-- Modal Thêm mới -->
<style>
    .select2-container--open {
        z-index: 9999;
    }
</style>

<!-- Modal edit bưu kiện -->
<div class="modal fade" id="modalEditParcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <form method="post">
                <div class="modal-body text-center px-5">
                    <div class="row justify-content-between">
                        <div class="col-12 text-center h4 fw-normal mb-5 pb-3">
                            Thông tin bưu kiện
                        </div>
                        <div class="col-12 my-2 text-start">
                            <?= show_error($error_valid) ?>
                        </div>
                        <div class="col-6 row align-content-start">
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="id_parcel">Mã bưu kiện (không thể sửa)</label>
                                <input readonly name="id_parcel" id="id_parcel" value="<?= $id_parcel ?>" type="text" placeholder="Nhập mã bưu kiện"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="brand_post">Đơn vị vận chuyển</label>
                                <select name="brand_post" id="brand_post" class="form-select ps-0 border-0 border-bottom border-2 outline-none">
                                    <option value="0" selected>--- Chọn đơn vị ---</option>
                                    <?php foreach (ARR_POST_BRAND as $i => $name): ?>
                                        <option <?= $brand_post == $name ? 'selected' : '' ?> value="<?= $name ?>"><?= $name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="username">Mã nhân viên</label>
                                <input readonly name="username" id="username" value="<?= $username ?>" type="text" placeholder="Mã nhân viên"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="date_sent">Ngày gửi</label>
                                <input name="date_sent" id="date_sent" value="<?= $date_sent ?>" type="date" class="form-control ps-0 border-0 border-bottom border-2 outline-none datepicker-here"
                                    data-auto-close="true" data-language="en" aria-label="Datepicker" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="fee">Phí gửi</label>
                                <input id="fee" name="fee" type="number" value="<?= $fee ?>"  placeholder="Nhập phí vận chuyển" class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="cod">Tiền thu hộ COD</label>
                                <input id="cod" name="cod" type="number" value="<?= $cod ?>"  placeholder="Nhập COD" class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="province_receiver">Tỉnh thành</label>
                                <select name="province_receiver" id="province_receiver" class="form-select ps-0 border-0 border-bottom border-2 outline-none">
                                    <option value="0" selected disabled>--- Chọn tỉnh thành ---</option>
                                    <?php foreach (ARR_PROVINCE as $i => $item): ?>
                                        <option <?= $province_receiver == $item['name'] ? 'selected' : '' ?> value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="state_parcel">Trạng thái</label>
                                <select name="state_parcel" id="state_parcel" class="form-select ps-0 border-0 border-bottom border-2 outline-none">
                                    <option value="0" selected disabled>--- Chọn trạng thái ---</option>
                                    <?php foreach (ARR_STATE_POST as $i => $item): ?>
                                        <option <?= $state_parcel == $item['name'] ? 'selected' : '' ?> value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-6 row align-content-start">
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="name_receiver">Họ tên người nhận</label>
                                <input name="name_receiver" value="<?= $name_receiver ?>" id="name_receiver" type="text" placeholder="Nhập họ và tên người nhận"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="phone_receiver">Số điện thoại</label>
                                <input name="phone_receiver" value="<?= $phone_receiver ?>" id="phone_receiver" type="text" placeholder="Nhập số điện thoại người nhận"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="address_receiver">Địa chỉ</label>
                                <input name="address_receiver" id="address_receiver" type="text" placeholder="Nhập địa chỉ người nhận"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="name_product">Sản phẩm</label>
                                <input name="name_product" value="<?= $name_product ?>" id="name_product" type="text" placeholder="Nhập tên sản phẩm"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-12 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="note">Ghi chú về bưu kiện</label>
                                <textarea name="note" value="<?= $note ?>" id="note" rows="5" placeholder="Nhập ghi chú về bưu kiện"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button name="editParcel" type="submit" class="w-btn-fill btn btn-primary text-light ms-2">Cập nhật</button>
                            <button type="button" class="w-btn-fill btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal thêm bưu kiện -->
<div class="modal fade" id="modalAddParcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <form method="post">
                <div class="modal-body text-center px-5">
                    <div class="row justify-content-between">
                        <div class="col-12 text-center h4 fw-normal mb-5 pb-3">
                            Thông tin bưu kiện
                        </div>
                        <div class="col-12 my-2 text-start">
                            <?= show_error($error_valid) ?>
                        </div>
                        <div class="col-6 row align-content-start">
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="id_parcel">Mã bưu kiện</label>
                                <input name="id_parcel" id="id_parcel" value="<?= $id_parcel ?>" type="text" placeholder="Nhập mã bưu kiện"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="brand_post">Đơn vị vận chuyển</label>
                                <select name="brand_post" id="brand_post" class="form-select ps-0 border-0 border-bottom border-2 outline-none">
                                    <option value="0" selected>--- Chọn đơn vị ---</option>
                                    <?php foreach (ARR_POST_BRAND as $i => $name): ?>
                                        <option <?= $brand_post == $name ? 'selected' : '' ?> value="<?= $name ?>"><?= $name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="username">Mã nhân viên</label>
                                <input readonly name="username" id="username" value="<?= $username ?>" type="text" placeholder="Nhập mã bưu kiện"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="date_sent">Ngày gửi</label>
                                <input name="date_sent" id="date_sent" value="<?= $date_sent ?>" type="date" class="form-control ps-0 border-0 border-bottom border-2 outline-none datepicker-here"
                                    data-auto-close="true" data-language="en" aria-label="Datepicker" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="fee">Phí gửi</label>
                                <input name="fee" type="number" value="<?= $fee ?>"  placeholder="Nhập phí vận chuyển" class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="cod">Tiền thu hộ COD</label>
                                <input name="cod" type="number" value="<?= $cod ?>"  placeholder="Nhập COD" class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="province_receiver">Tỉnh thành</label>
                                <select name="province_receiver" id="province_receiver" class="form-select ps-0 border-0 border-bottom border-2 outline-none">
                                    <option value="0" selected disabled>--- Chọn tỉnh thành ---</option>
                                    <?php foreach (ARR_PROVINCE as $i => $item): ?>
                                        <option <?= $province_receiver == $item['name'] ? 'selected' : '' ?> value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="state_parcel">Trạng thái</label>
                                <select name="state_parcel" id="state_parcel" class="form-select ps-0 border-0 border-bottom border-2 outline-none">
                                    <option value="0" selected disabled>--- Chọn trạng thái ---</option>
                                    <?php foreach (ARR_STATE_POST as $i => $item): ?>
                                        <option <?= $state_parcel == $item['name'] ? 'selected' : '' ?> value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-6 row align-content-start">
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="name_receiver">Họ tên người nhận</label>
                                <input name="name_receiver" value="<?= $name_receiver ?>" id="name_receiver" type="text" placeholder="Nhập họ và tên người nhận"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="phone_receiver">Số điện thoại</label>
                                <input name="phone_receiver" value="<?= $phone_receiver ?>" id="phone_receiver" type="text" placeholder="Nhập số điện thoại người nhận"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="address_receiver">Địa chỉ</label>
                                <input name="address_receiver" value="<?= $address_receiver ?>" id="address_receiver" type="text" placeholder="Nhập địa chỉ người nhận"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="name_product">Sản phẩm</label>
                                <input name="name_product" value="<?= $name_product ?>" id="name_product" type="text" placeholder="Nhập tên sản phẩm"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-12 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="note">Ghi chú về bưu kiện</label>
                                <textarea name="note" value="<?= $note ?>" id="note" rows="5" placeholder="Nhập ghi chú về bưu kiện"
                                    class="form-control ps-0 border-0 border-bottom border-2 outline-none"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button name="addParcel" type="submit" class="w-btn-fill btn btn-primary text-light ms-2">Xác nhận</button>
                            <button type="button" class="w-btn-fill btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>



<script>
    function getOnePost(id) {
        // Hiện modal
        var myModal = new bootstrap.Modal(document.getElementById('modalEditParcel'));

        // Gửi yêu cầu AJAX để lấy dữ liệu
        $.ajax({
            url: `/admin/getParcel?id=${id}`, // Sử dụng template string để chèn ID
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                // Kiểm tra nếu status là 200
                if (response.status === 200) {
                    const data = response.data; // Lấy dữ liệu

                    // Gán giá trị vào các input có ID tương ứng
                    $("#id_parcel").val(data.id_parcel || '');
                    $("#brand_post").val(data.brand_post || '');
                    $("#username").val(data.username || '');
                    $("#date_sent").val(data.date_sent || '');
                    $("#name_receiver").val(data.name_receiver || '');
                    $("#phone_receiver").val(data.phone_receiver || '');
                    $("#address_receiver").val(data.address_receiver || '');
                    $("#province_receiver").val(data.province_receiver || '');
                    $("#fee").val(data.fee || '');
                    $("#cod").val(data.cod || '');
                    $("#name_product").val(data.name_product || '');
                    $("#note").val(data.note || '');
                    $("#state_parcel").val(data.state_parcel || '');

                    // Hiện modal sau khi đã gán giá trị
                    myModal.show();
                } else {
                    console.error('Error: ', response.message); // Xử lý nếu status không phải 200
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }
    function updatePost(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định nếu cần
        const target = e.currentTarget; // Phần tử được gán sự kiện

        const id_parcel = target.getAttribute('data-id'); // Lấy data-id
        const stateSelect = target.closest('tr')?.querySelector('select[name="state_parcel"]'); // Tìm phần tử select gần nhất

        if (!id_parcel || !stateSelect) {
            console.error('Không tìm thấy ID hoặc trạng thái bưu kiện.');
            return;
        }

        const state_parcel = stateSelect.value;

        $.ajax({
            url: '/admin/quan-li-buu-kien',
            type: 'POST',
            data: {
                editParcel: true,
                id_parcel: id_parcel,
                state_parcel: state_parcel
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 200) {
                    const stateMap = <?php
                        // Chuyển mảng ARR_STATE_POST thành associative array theo key là 'name'
                        $mapped = [];
                        foreach (ARR_STATE_POST as $item) {
                            $name = $item['name'];
                            $mapped[$name] = [
                                'color' => $item['color'],
                                'text_color' => isset($item['text_color']) ? $item['text_color'] : 'white'
                            ];
                        }
                        echo json_encode($mapped, JSON_UNESCAPED_UNICODE);
                        ?>;

                    const styleData = stateMap[state_parcel];
                    if (styleData) {
                        target.style.backgroundColor = styleData.color;
                        target.style.color = styleData.text_color || 'white';
                    } else {
                        console.warn('Không có style tương ứng với trạng thái:', state_parcel);
                    }
                } else {
                    console.warn('Yêu cầu thành công nhưng status khác 200:', response.status);
                }
            },
            error: function (xhr, status, error) {
                console.error('Lỗi khi gửi yêu cầu:', error);
            }
        });
    }

</script>
<script>
    document.getElementById('printParcel').addEventListener('click', function() {
    // Lấy dữ liệu từ bảng
    var table = document.getElementById('dataTable');
    var data = [];

    // Lấy tiêu đề cột
    var headers = Array.from(table.querySelectorAll('thead th')).map(th => th.innerText);
    data.push(headers);

    // Lấy dữ liệu các hàng
    table.querySelectorAll('tbody tr').forEach(row => {
        var rowData = Array.from(row.querySelectorAll('td')).map(td => {
            return {
                v: td.innerText, // Lấy giá trị văn bản
                t: 's', // Đặt kiểu dữ liệu là string
                s: { // Đặt thuộc tính kiểu cho ô
                    alignment: {
                        horizontal: 'center' // Căn giữa
                    }
                }
            };
        });
        data.push(rowData);
    });

    // Tạo workbook từ dữ liệu
    var worksheet = XLSX.utils.aoa_to_sheet(data);
    var workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

    // Đặt độ rộng cho các cột
    worksheet['!cols'] = [
        { wpx: 100 },
        { wpx: 100 },
        { wpx: 100 },
        { wpx: 100 },
        { wpx: 200 },
        { wpx: 100 },
        { wpx: 200 },
        { wpx: 80 },
        { wpx: 80 },
        { wpx: 120 },
        { wpx: 120 },
        { wpx: 120 }
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
    XLSX.writeFile(workbook, 'du_lieu_buu_kien_' + formattedDate + '.xlsx');
});
</script>
<script>
$(document).ready(function () {
    function loadParcel(keyword, filterPostParcel, startDate, endDate, filterState, paginate) {
        // Thay thế nội dung box-result bằng loading indicator
        $("#resultParcel").html(`
            <tr class="align-middle">
                <td class="text-center" colspan="12">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </td>
            </tr>
        `);

        const url = `/admin/filterParcel?keyword=${encodeURIComponent(keyword)}` +
                    `&postParcel=${encodeURIComponent(filterPostParcel)}` +
                    `&start_date=${encodeURIComponent(startDate)}` +
                    `&end_date=${encodeURIComponent(endDate)}` +
                    `&filterState=${encodeURIComponent(filterState)}` +
                    `&paginate=${encodeURIComponent(paginate)}`;

        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 200) {
                    $("#resultParcel").html(response.data); // Cập nhật nội dung mới
                    $("#resultPaginate").html(response.paginate); // Cập nhật nội dung mới
                    $("#resultCount").html(response.count); // Cập nhật nội dung mới
                } else {
                    $("#resultParcel").html("<tr class='align-middle'><td class='text-center' colspan='12'>Lỗi khi tải dữ liệu ! Vui lòng kiểm tra kết nối mạng hoặc đợi Admin hỗ trợ.</td></tr>");
                }
            },
            error: function () {
                console.log("Đã có lỗi xảy ra.");
                $("#resultParcel").html("<tr class='align-middle'><td class='text-center' colspan='12'>Lỗi khi tải dữ liệu ! Vui lòng kiểm tra kết nối mạng hoặc đợi Admin hỗ trợ.</td></tr>");
            }
        });
    }

    // Biến để lưu trữ giá trị hiện tại
    let currentKeyword = '';
    let currentFilterPostParcel = 0; // Giá trị mặc định cho filterPostParcel
    let currentStartDate = ''; // Giá trị mặc định cho ngày bắt đầu
    let currentEndDate = ''; // Giá trị mặc định cho ngày kết thúc
    let currentFilterState = 0; // Giá trị mặc định cho filterState
    let currentPaginate = 1;

    // Theo dõi sự kiện nhập liệu trong ô tìm kiếm
    $('input[name="searchParcel"]').on('input', function () {
        currentKeyword = $(this).val();
        loadParcel(currentKeyword, currentFilterPostParcel, currentStartDate, currentEndDate, currentFilterState,currentPaginate);
    });

    // Theo dõi sự kiện thay đổi trong dropdown lọc đơn vị
    $('select[name="filterPostParcel"]').on('change', function () {
        currentFilterPostParcel = $(this).val();
        loadParcel(currentKeyword, currentFilterPostParcel, currentStartDate, currentEndDate, currentFilterState,currentPaginate);
    });

    // Theo dõi sự kiện thay đổi trong ô nhập ngày bắt đầu
    $('input[name="start_date"]').on('change', function () {
        currentStartDate = $(this).val();
        loadParcel(currentKeyword, currentFilterPostParcel, currentStartDate, currentEndDate, currentFilterState,currentPaginate);
    });

    // Theo dõi sự kiện thay đổi trong ô nhập ngày kết thúc
    $('input[name="end_date"]').on('change', function () {
        currentEndDate = $(this).val();
        loadParcel(currentKeyword, currentFilterPostParcel, currentStartDate, currentEndDate, currentFilterState,currentPaginate);
    });

    // Theo dõi sự kiện thay đổi trong dropdown lọc trạng thái
    $('select[name="filterState"]').on('change', function () {
        currentFilterState = $(this).val();
        loadParcel(currentKeyword, currentFilterPostParcel, currentStartDate, currentEndDate, currentFilterState,currentPaginate);
    });

    // Sử dụng event delegation để bắt sự kiện click
    $('#resultPaginate').on('click', '.btn-paginate', function () {
        console.log("Button clicked!"); // Kiểm tra xem sự kiện click có hoạt động hay không
        const paginateValue = $(this).val();

        // Kiểm tra nếu paginateValue không có hoặc bằng 0
        if (!paginateValue || paginateValue == '0') {
            console.log("Không thể fetch dữ liệu vì giá trị phân trang không hợp lệ.");
            return; // Dừng lại nếu điều kiện không thỏa mãn
        }
        loadParcel(currentKeyword, currentFilterPostParcel, currentStartDate, currentEndDate, currentFilterState, paginateValue);
    });

});
</script>
