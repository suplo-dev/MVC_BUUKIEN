<!-- sa-app__body -->
<div id="top" class="sa-app__body">
    <div class="pb-5">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="sa-divider"></div>
                <!-- <table class="sa-datatables-init table table-hover border-muted" data-order="[[ 9, &quot;asc&quot; ]]" data-sa-search-input="#table-search"> -->
                <table class="table table-striped table-hover border-muted mb-5">
                    <thead>
                        <tr class="small">
                            <!-- <th class="w-min">ID</th> -->
                            <th class="col-1 text-center">Mã bưu kiện</th>
                            <th class="col-1 text-center">Chuyển phát</th>
                            <th class="col-1 text-center">Mã NV</th>
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
                    <tbody>
                        <?php if($list_parcel) : ?>
                        <?php foreach ($list_parcel as $parcel) : ?>
                            <tr class="small" onclick="getOnePost('<?= $parcel['id_parcel'] ?>')">
                                <td class="small align-middle text-center">
                                    <?= $parcel['id_parcel'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $parcel['brand_post'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $parcel['username'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $parcel['date_sent'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $parcel['name_receiver'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $parcel['phone_receiver'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $parcel['address_receiver'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $parcel['fee'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $parcel['cod'] ?>
                                </td>
                                <td class="small align-middle text-center">
                                    <?= $parcel['name_product'] ?>
                                </td>
                                <td class="small align-middle text-center text-light">
                                    <?php foreach (ARR_STATE_POST as $state) : extract($state) ?>
                                    <?php if(strcasecmp($name,$parcel['state_parcel']) === 0) : ?>
                                        <span class="p-2 small d-block text-center" style="background-color : <?= $color ?>">
                                            <?= $name ?>
                                        </span>
                                    <?php endif ?>
                                    <?php endforeach ?>
                                </td>
                                <td class="small align-middle text-center">
                                    Ghi chú nè
                                </td>
                            </tr>
                        <?php endforeach ?>
                        <?php else : ?>
                            <tr class="small">
                                <td colspan="12" class="align-middle text-center">
                                    Dữ liệu trống
                                </td>
                            </tr>
                        <?php endif ?>
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
            <select class="form-select form-select-sm border-0 bg-blue-light text-light rounded-0">
                <option value="0" selected disabled>- Lọc đơn vị -</option>
                <?php foreach (ARR_POST_BRAND as $i => $name): ?>
                    <option value="<?= ++$i ?>"><?= $name ?></option>
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
                                <input type="date" class="form-control" placeholder="Username" aria-label="Username">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text w-25">
                                    <small>Đến ngày</small>
                                </span>
                                <input type="date" class="form-control" placeholder="Username" aria-label="Username">
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-sm btn-primary text-light small">Xác nhận lọc</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-6 invisible">
            space
        </div>

        <div class="col-1">
            <select class="form-select form-select-sm border-0 bg-blue-light text-light rounded-0">
                <option value="0" selected disabled>- Lọc trạng thái -</option>
                <?php foreach (ARR_STATE_POST as $i => $item): extract($item)?>
                    <option value="<?= ++$i ?>"><?= $name ?></option>
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
                                <input name="fee" type="number" value="<?= $fee ?>"  placeholder="Nhập phí vận chuyển" class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="cod">Tiền thu hộ COD</label>
                                <input name="cod" type="number" value="<?= $cod ?>"  placeholder="Nhập COD" class="form-control ps-0 border-0 border-bottom border-2 outline-none" />
                            </div>
                            <div class="col-6 py-2 px-3 text-start mb-4">
                                <label class="small text-muted" for="address_receiver">Tỉnh thành</label>
                                <select name="address_receiver" id="address_receiver" class="form-select ps-0 border-0 border-bottom border-2 outline-none">
                                    <option value="0" selected disabled>--- Chọn địa điểm ---</option>
                                    <?php foreach (ARR_PROVINCE as $i => $name): ?>
                                        <option <?= $address_receiver == $name ? 'selected' : '' ?> value="<?= $name ?>"><?= $name ?></option>
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
                                <label class="small text-muted" for="none">Địa chỉ</label>
                                <input name="none" id="none" type="text" placeholder="Nhập địa chỉ người nhận"
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
                                <label class="small text-muted" for="address_receiver">Tỉnh thành</label>
                                <select name="address_receiver" id="address_receiver" class="form-select ps-0 border-0 border-bottom border-2 outline-none">
                                    <option value="0" selected disabled>--- Chọn địa điểm ---</option>
                                    <?php foreach (ARR_PROVINCE as $i => $name): ?>
                                        <option <?= $address_receiver == $name ? 'selected' : '' ?> value="<?= $name ?>"><?= $name ?></option>
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
                                <label class="small text-muted" for="none">Địa chỉ</label>
                                <input name="none" id="none" type="text" placeholder="Nhập địa chỉ người nhận"
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
</script>
